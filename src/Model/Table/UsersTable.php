<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    public function parentNode() {
        return null;
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('username');
        $this->setPrimaryKey('id');

        //behaviors
        $this->addBehavior('Timestamp');
        $this->addBehavior('Acl.Acl', ['type' => 'requester']);
        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->value('user_id')
            // Here we will alias the 'q' query param to search the `Articles.title`
            // field and the `Articles.content` field, using a LIKE match, with `%`
            // both before and after.
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'iLIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['username', 'name', 'surname', 'email']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
            ]);

        //associations
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('LessonEditions');
        
        //booked lesson editions
        $this->hasMany('BookedLessonEditions', [
                'className' => 'LessonEditions'
            ])
        ->setConditions(
                ['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']]
                )
        ->setProperty('booked_lesson_editions');

        $this->hasMany('Activities');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('username')
            ->maxLength('username', 25)
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->email('email')
            ->allowEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmpty('name');

        $validator
            ->scalar('surname')
            ->maxLength('surname', 255)
            ->allowEmpty('surname');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 255);


        return $validator;
    }

    // Active User Finder
    public function findActive(Query $query)
    {
        $query->contain('Roles');
        $query->where(['active' => true]);
        return $query;
    }

    public function findTrainers(Query $query)
    {

        $query->where(['role_id' => Configure::read('roles')['trainer'] ]);
        return $query;
    }

    public function findStaffMembers(Query $query)
    {

        $query->where(['role_id' => Configure::read('roles')['trainer'] ]);
        $query->orwhere(['role_id' => Configure::read('roles')['staff'] ]);
        $query->orwhere(['role_id' => Configure::read('roles')['admin'] ]);
        return $query;
    }      

    public function findMembers(Query $query)
    {
        //$query->contain('Roles');
        $query->where(['role_id' => Configure::read('roles')['member'] ]);
        return $query;
    }

    public function findByName(Query $query, $options)
    {   
        $query->contain('Roles');
        $query->andWhere(['users.name iLike' => '%'.$options['name'].'%']);
        return $query;
    }

    public function findByUsername(Query $query, $options)
    {   
        $query->contain('Roles');
        $query->andWhere(['username iLike' => '%'.$options['username'].'%']);
        return $query;
    }

    public function findBySurname(Query $query, $options)
    {   
        $query->contain('Roles');
        $query->andWhere(['users.surname iLike' => '%'.$options['name'].'%']);
        return $query;
    }

    public function findUserDetails(Query $query)
    {
        $query->contain('Roles', 'Athletes');
        return $query;
    }

    public function findUsersByRole(Query $query, $options)
    {
        $query->contain('Roles', 'Athletes');
        $query->where(['role_id' => $options['role_id']]);
        return $query;
    }

    /**
    *   Free Trainers Finder
    *   Finds Trainers that are not busy with something during a time frame that must be passed as in the options
    * 
    */

    public function findFreeTrainers(Query $query, $options)
    {
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $excludeEvent = null;
        if ($options['exclude'] != null) {
           $excludeEvent = $options['exclude']; 
        }
        $query->select(['id','username']);
        $query->distinct();
        $query->where(['role_id' => Configure::read('roles')['trainer'], ['active' => true ]]);
        //load activities
        $query->contain('Activities.Events', function (Query $q) use($periodStart, $periodEnd) {
            $q->where(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);
            return $q;          
        });
        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']]);
            $q->orwhere(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['scheduled']]);
            $q->andWhere(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);

            if ($excludeEvent) {
                $q->andWhere(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        $mapper = function ($user, $key, $mapReduce) {
            if (count($user->lesson_editions) == 0 && count($user->activities) == 0 ) {
                $mapReduce->emit($user);
            }
        };
        $query->mapReduce($mapper);

        return $query;
    }

    public function findFree(Query $query, $options)
    {
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $excludeEvent = null;
        if ($options['exclude'] != null) {
           $excludeEvent = $options['exclude']; 
        }
        $query->select(['id','username']);
        $query->distinct();
        $query->where(['role_id <>' => Configure::read('roles')['admin'], ['active' => true ]]);
        //load activities
        $query->contain('Activities.Events', function (Query $q) use($periodStart, $periodEnd) {
            $q->where(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);
            return $q;          
        });
        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']]);
            $q->orwhere(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['scheduled']]);
            $q->andWhere(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);

            if ($excludeEvent) {
                $q->andWhere(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        $mapper = function ($user, $key, $mapReduce) {
            if (count($user->lesson_editions) == 0 && count($user->activities) == 0 ) {
                $mapReduce->emit($user);
            }
        };
        $query->mapReduce($mapper);

        return $query;
    }

    public function findBusyTrainers(Query $query, $options)
    {
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $excludeEvent = null;
        if ($options['exclude'] != null) {
           $excludeEvent = $options['exclude']; 
        }
        $query->select(['id','username']);
        $query->distinct();
        $query->where(['role_id' => Configure::read('roles')['trainer']]);
        //load activities
        $query->contain('Activities.Events', function (Query $q) use($periodStart, $periodEnd) {
            $q->where(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);
            return $q;          
        });
        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']]);
            $q->orwhere(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['scheduled']]);
            $q->andWhere(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);

            if ($excludeEvent) {
                $q->andWhere(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        $mapper = function ($user, $key, $mapReduce) {
            if (count($user->lesson_editions) > 0 || count($user->activities) > 0 ) {
                $mapReduce->emit($user);
            }
        };
        $query->mapReduce($mapper);

        return $query;
    }

    public function findBusy(Query $query, $options)
    {
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $excludeEvent = null;
        if ($options['exclude'] != null) {
           $excludeEvent = $options['exclude']; 
        }
        $query->select(['id','username']);
        $query->distinct();
        $query->where(['role_id <>' => Configure::read('roles')['admin']]);
        //load activities
        $query->contain('Activities.Events', function (Query $q) use($periodStart, $periodEnd) {
            $q->where(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);
            return $q;          
        });
        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']]);
            $q->orwhere(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['scheduled']]);
            $q->andWhere(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);

            if ($excludeEvent) {
                $q->andWhere(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        $mapper = function ($user, $key, $mapReduce) {
            if (count($user->lesson_editions) > 0 || count($user->activities) > 0 ) {
                $mapReduce->emit($user);
            }
        };
        $query->mapReduce($mapper);

        return $query;
    }

//liberi
// 1: hanno attività che finiscono prima dell'inizio del periodo richiesto
// 2: hanno attività che iniziano dopo la fine del periodo richiesto
// 3: 
/*
    public function findFreeTrainers(Query $query, $options)
    {
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $query->select(['id', 'username']);
        $query->distinct();
        $query->where(['role_id' => Configure::read('roles')['trainer']]);
        $query->notMatching('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd) {
            $q->where(['OR' => [
                    ['start_date >' => $periodStart, 'start_date <' => $periodEnd],
                    ['end_date >' => $periodStart, 'end_date <' => $periodEnd],
                    ['start_date <=' => $periodStart, 'end_date >=' => $periodEnd]
                ]]);
            $q->where(['lesson_edition_status_id' => 3]);
            return $q;
                 
        });
        return $query;
    }
*/

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['fiscal_code']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
