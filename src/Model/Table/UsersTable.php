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

        //$this->hasMany('Activities');
        $this->hasMany('ActivityUsers');

        $this->hasMany('UsersAvailability');

        $this->hasMany('CourseSessionTrainers');
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

    public function findStaff(Query $query)
    {

        $query->where(['role_id' => Configure::read('roles')['trainer'] ]);
        $query->orwhere(['role_id' => Configure::read('roles')['staff'] ]);
        $query->orwhere(['role_id' => Configure::read('roles')['admin'] ]);
        $query->orwhere(['role_id' => Configure::read('roles')['manager'] ]);
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

    //FIinds users not busy in any lesson_edition or activity in the given time frame, you can pass the id of an event to exclude from the search, useful when used in an action related to an event. 
    public function findFree(Query $query, $options)
    {
        //debug($options);
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $excludeEvent = null;

        if ($options['exclude'] != null) {
           $excludeEvent = $options['exclude']; 
        }

        $query->select(['id','username']);
        //Exclude the admin role, admins do not take part in activities!!!!
        $query->where(['role_id <>' => Configure::read('roles')['admin'], ['active' => true ]]);

        $query->matching('UsersAvailability', function ($q) use ($periodStart) {
            return $q->where(['UsersAvailability.start_date' => $periodStart->startOfDay()]);
        });

        //load activities
        $query->contain('ActivityUsers.Activities.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['OR' => [
                    //consider events that start before and ends after the period
                    ['events.start_date <' => $periodStart, 'events.end_date >' => $periodEnd],
                    //consider events that starts inside the period
                    ['start_date >=' => $periodStart, 'start_date <' => $periodEnd],
                    //consider events that ends inside the period
                    ['end_date >' => $periodStart, 'end_date <=' => $periodEnd],
                    //consider events that stats and ends during the period
                    ['start_date >=' => $periodStart, 'end_date <=' => $periodEnd],                    
                ]]);
            $q->andWhere(['activity_status_id <' => Configure::read('activity_statuses')['completed']]);
            //$q->andWhere(['activity_status_id <>' => Configure::read('activity_statuses')['draft']]);

            if ($excludeEvent) {
                $q->where(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id <' => Configure::read('lesson_edition_statuses')['completed']]);
            $q->andWhere(['OR' => [
                    //consider events that start before and ends after the period
                    ['events.start_date <' => $periodStart, 'events.end_date >' => $periodEnd],
                    //consider events that starts inside the period
                    ['start_date >=' => $periodStart, 'start_date <' => $periodEnd],
                    //consider events that ends inside the period
                    ['end_date >' => $periodStart, 'end_date <=' => $periodEnd],
                    //consider events that stats and ends during the period
                    ['start_date >=' => $periodStart, 'end_date <=' => $periodEnd], 
                ]]);
           // $q->where(['lesson_edition_status_id <' => Configure::read('lesson_edition_statuses')['completed']]);

            if ($excludeEvent) {
                $q->where(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        //load course_sessions
        $query->contain('CourseSessionTrainers.CourseSessions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['course_session_status_id <' => Configure::read('course_session_statuses')['completed']]);
            $q->andWhere(['OR' => [
                    //consider events that start before and ends after the period
                    ['events.start_date <' => $periodStart, 'events.end_date >' => $periodEnd],
                    //consider events that starts inside the period
                    ['start_date >=' => $periodStart, 'start_date <' => $periodEnd],
                    //consider events that ends inside the period
                    ['end_date >' => $periodStart, 'end_date <=' => $periodEnd],
                    //consider events that stats and ends during the period
                    ['start_date >=' => $periodStart, 'end_date <=' => $periodEnd], 
                ]]);
            //$q->where(['lesson_edition_status_id <' => Configure::read('lesson_edition_statuses')['completed']]);

            if ($excludeEvent) {
                $q->where(['Events.id <>' => $excludeEvent]);
            }
            return $q;          
        });

        $mapper = function ($user, $key, $mapReduce) {
            // ***** START finder DEBUG
            //debug($user->username.': lezioni -> '.count($user->lesson_editions).' | attività -> '.count($user->activity_users) );
            // ***** END finder DEBUG
            //debug($user);
            if (count($user->lesson_editions) == 0 && count($user->activity_users) == 0 && count($user->course_session_trainers) == 0 ) {
                $mapReduce->emit($user);
            }
        };

        $query->mapReduce($mapper);
        return $query;
    }


    public function findUnavailableUsers($query, $options) {
        
        $query->contain(['UsersAvailability']);
        $query->where(['UsersAvailability.start_date <>' => $options['day']->startOfDay()]);
        return $query;
    }

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
