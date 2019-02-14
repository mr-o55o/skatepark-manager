<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Core\Configure;
use Cake\Chronos\Chronos;

/**
 * Athletes Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Athlete get($primaryKey, $options = [])
 * @method \App\Model\Entity\Athlete newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Athlete[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Athlete|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Athlete|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Athlete patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Athlete[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Athlete findOrCreate($search, callable $callback = null, $options = [])
 */
class AthletesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('athletes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'iLIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['name', 'surname']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
            ]);

        $this->belongsTo('ResponsiblePersons', [
            'foreignKey' => 'responsible_person_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasMany('LessonEditions');
        $this->hasMany('PurchasedLessonEditionsBundles');

        /* Active lesson Editions association
            - A lesson edition is active when starts in the future
        */
        $this->hasMany('BookedLessonEditions', [
                'className' => 'LessonEditions',
            ])
            ->setConditions(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked'] ])
            ->setProperty('booked_lesson_editions');

         /* Completed lesson Editions association
            - A lesson edition is completed when starts in the past and has the completed status
         */
        $this->hasMany('CompletedLessonEditions', [
                'className' => 'LessonEditions'
            ])
            ->setConditions(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['completed'] ])
            ->setProperty('completed_lesson_editions');
    }

    /**
     * ExpiredFinder - Finds Athletes with expired ASI Subscriptions
     * asi_subscription_date < now(-1 year)
     */

    public function findExpired($query, $options)
    {
        return $query->where(['asi_subscription_date <' => Time::now()->modify('-1 Year')]);
    }
    /**
     * ActiveFinder - Finds Athletes with active ASI Subscriptions
     * asi_subscription_date > now(-1 year)
     */
    public function findActive($query, $options)
    {
        return $query->where(['asi_subscription_date >' => Time::now()->modify('-1 Year')]);
    }

    public function findBySurname(Query $query, $options)
    {   
        $query->Where(['surname iLike' => '%'.$options['athleteSearch'].'%']);
        return $query;
    } 

    //finds athlete not associated to any lesson edition in a selected time frame, it is possible to exclude 1 event id
    public function findFree(Query $query, $options)
    {
        $periodStart = $options['start_date'];
        $periodEnd = $options['end_date'];
        $excludeEvent = null;
        if ($options['exclude'] != null) {
           $excludeEvent = $options['exclude']; 
        }
        $query->select(['id','name', 'surname', 'asi_subscription_number']);
        $query->distinct();
        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id'] == Configure::read('lesson_edition_statuses')['booked']);
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

        $mapper = function ($athlete, $key, $mapReduce) {
            if (count($athlete->lesson_editions) == 0 ) {
                $mapReduce->emit($athlete);
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
        $query->select(['id','name', 'surname', 'asi_subscription_number']);
        $query->distinct();
        //load lesson editions
        $query->contain('LessonEditions.Events', function (Query $q) use($periodStart, $periodEnd, $excludeEvent) {
            $q->where(['lesson_edition_status_id'] == Configure::read('lesson_edition_statuses')['booked']);
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

        $mapper = function ($athlete, $key, $mapReduce) {
            if (count($athlete->lesson_editions) > 0 ) {
                $mapReduce->emit($athlete);
            }
        };
        $query->mapReduce($mapper);

        return $query;
    }
/*
    public function findSearch(Query $query, array $options)
    {
        if ($options['name']) {
            $query->where(['athletes.name ILIKE' => '%'.$options['name'].'%']);  
        }
        if ($options['surname']) {
            $query->andWhere(['athletes.surname ILIKE' => '%'.$options['surname'].'%']);
        }
        return $query;
    }
*/

    public function findSearchBySurnameActive(Query $query, array $options)
    {
        $oneYearAgo = new Time('1 year ago');
        $query->where(['asi_subscription_date >' => $oneYearAgo]);
        $query->andWhere(['athletes.surname ILIKE' => '%'.$options['surname'].'%']);
        return $query;
    }

    public function findSearchBySurname($query, $options)
    {
        $query->where(['athletes.surname ILIKE' => '%'.$options['surname'].'%']);
        return $query;
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('surname')
            ->maxLength('surname', 255)
            ->requirePresence('surname', 'create')
            ->notEmpty('surname');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmpty('birthdate');

        $validator
            ->integer('asi_subscription_number')
            ->maxLength('asi_subscription_number', 255)
            ->notEmpty('asi_subscription_number');

        $validator
            ->date('asi_subscription_date')
            ->allowEmpty('asi_subscription_date');

        $validator
            ->integer('responsible_person_id')
            ->notEmpty('asi_subscription_date');


        return $validator;
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
        //Standard FK rule
        $rules->add($rules->existsIn(['responsible_person_id'], 'ResponsiblePersons'));

        //ASi Subscription Number must be unique
        $rules->add($rules->isUnique(['asi_subscription_number']), [
            'errorField' => 'asi_subscription_number',
            'message' => 'Application Rule Violated: Asi subscription number must be unique'
        ]);

        //Birthdate must be less than.. now?
        $rules->addCreate(function ($entity, $options) {
        // Return a boolean to indicate pass/failure
            if ( $entity->birthdate >= Time::now() ) {
                return false;
            }
            return true;

        }, 'birthdateInTheFuture', ['errorField' => 'birthdate', 'message' => 'Application Rule violated: birthdate date cannot be in the future']);

        //responsible_person is mandatory if athlete is under 18
        $rules->add(function($entity, $options) {
            $age = $entity->birthdate->diffInYears( Chronos::now() );
            if ($age < 18) {
                if (!$entity->responsible_person_id) {
                    return false;
                }
            }
            return true;

        }, 'minorWithoutResponsible', ['errorField' => 'responsible_person', 'message' => 'Athlete is under 18, responsible person is mandatory']);
        return $rules;
    }
}
