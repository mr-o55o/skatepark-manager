<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;
use Cake\Core\Configure;
use Cake\Chronos\Chronos;
use CodiceFiscale\Validator as CfValidator;

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
        $this->addBehavior('Timestamp');

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

        $this->belongsTo('Provinces', [
            'birth_province' => array(
                'className' => 'Provinces',
                'foreignKey' => 'birt_province_code'
            ),
            'living_province' => array(
                 'className' => 'Provinces',
                 'foreignKey' => 'province_id'
            )
        ]);

        $this->belongsTo('AthleteRanks');

        $this->hasMany('AthletesNotes');

        $this->hasMany('LessonEditions');

        $this->hasMany('PurchasedLessonEditionsBundles');

        // i can't understand why entities are not saved with hasOne association
        $this->hasMany('ValidPurchasedLessonEditionsBundles', [
                'className' => 'PurchasedLessonEditionsBundles'
            ])
            ->setConditions(
                ['OR' => [['status <=' => 2, 'end_date >' => Time::now()],['status' => 1]]]
                )
            ->setProperty('valid_purchased_lesson_editions_bundles');
        

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
            $q->where(['lesson_edition_status_id <' => Configure::read('lesson_edition_statuses')['completed']]);

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
            ->allowEmpty('asi_subscription_number');

        $validator
            ->integer('responsible_person_id');

        $validator
            ->scalar('fiscal_code')
            ->maxLength('fiscal_code', 16)
            ->requirePresence('fiscal_code', 'create')
            ->notEmpty('fiscal_code')
            ->add('fiscal_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->notEmpty('birth_place');

        $validator
            ->notEmpty('athlete_rank_id');

        $validator
            ->notEmpty('birth_province_code');

        $validator
            ->notEmpty('city');

        $validator
            ->notEmpty('province_code');

        $validator
            ->email('email')
            ->allowEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->notEmpty('postal_code');

        $validator
            ->notEmpty('sex');

        $validator
            ->notEmpty('email');

        $validator
            ->notEmpty('disabled_person');

        $validator
            ->notEmpty('competitive');


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

        $rules->add($rules->existsIn(['birth_province_code'], 'Provinces'));
        $rules->add($rules->existsIn(['province_code'], 'Provinces'));
        $rules->add($rules->existsIn(['athlete_rank_id'], 'AthleteRanks'));

        //ASi Subscription Number must be unique
        $rules->add($rules->isUnique(['asi_subscription_number']), [
            'errorField' => 'asi_subscription_number',
            'message' => 'Application Rule Violated: Asi subscription number must be unique'
        ]);

        $rules->add(function($entity) {
            $cfValidator = new CfValidator($entity->fiscal_code);
            return $cfValidator->isFormallyValid();
        }, 'fiscalCodeFormalCheck', ['errorField' => 'fiscal_code', 'message' => 'Formal validation of fiscal code failed']);

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
