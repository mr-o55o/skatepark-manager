<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

use Cake\Core\Configure;

use ArrayObject;



/**
 * LessonEditions Model
 *
 * @property \App\Model\Table\LessonsTable|\Cake\ORM\Association\BelongsTo $Lessons
 * @property \App\Model\Table\LessonStatusesTable|\Cake\ORM\Association\BelongsTo $LessonStatuses
 * @property \App\Model\Table\AthletesTable|\Cake\ORM\Association\BelongsTo $Athletes
 *
 * @method \App\Model\Entity\LessonEdition get($primaryKey, $options = [])
 * @method \App\Model\Entity\LessonEdition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LessonEdition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonEdition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonEdition|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonEdition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LessonEdition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonEdition findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonEditionsTable extends Table
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

        $this->setTable('lesson_editions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Lessons', [
            'foreignKey' => 'lesson_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('LessonEditionStatuses', [
            'foreignKey' => 'lesson_edition_status_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Athletes', [
            'foreignKey' => 'athlete_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('LessonEditionsCalculations', [
            'foreignKey' => 'lesson_edition_calculation_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER'
        ]);

        //$this->hasOne('Events');
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'iLIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['Athletes.name', 'Athletes.surname']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
            ]);     

    }
/*
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        //debug('BeforeMarshal');
        //debug($data);
    }  
 
*/


/*
    public function findCompletedLessonEditionsByAthlete(Query $query, $options)
    {
        $query->where(['athlete_id' => $options['athlete_id']]);
        $query->andWhere(['start_date <' => Time::now()]);
        $query->andWhere(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['completed']]);
        return $query;
    }
*/
    public function findNext($query)
    {
        $query->contain(['Events']);
        $query->where(['Events.start_date >=' => Time::now()]);
        $query->order(['Events.start_date',]);
        return $query;
    }

    public function findByLesson(Query $query, $options)
    {
        $query->where(['lesson_id' => $options['lesson_id']]);
        return $query;
    }

    public function findWithAthlete(Query $query, $options)
    {
         $query->where(['athlete_id' => $options['athlete_id']]);
        return $query;       
    }

    public function findCompleted($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['completed']]);
        return $query;
    }

    public function findBooked($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']]);
        return $query;
    }

    public function findCompletedByAthlete($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['completed'], 'athlete_id' => $options['athlete_id']]);
        return $query;
    }

    public function findCancelledByAthlete($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['cancelled-athlete'], 'athlete_id' => $options['athlete_id']]);
        return $query;
    }

    public function findBookedByAthlete($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked'], 'athlete_id' => $options['athlete_id']]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('lesson_id')
            ->requirePresence('lesson_id', 'create')
            ->allowEmpty('lesson_id', 'create');

        $validator
            ->requirePresence('lesson_edition_status_id', 'create')
            ->allowEmpty('lesson_edition_status_id', 'create');
        /*
        $validator
            ->requirePresence('user_id', 'create')
            ->allowEmpty('user_id', 'create');       
        */
        $validator
            ->requirePresence('athlete_id', 'create')
            ->allowEmpty('athlete_id', 'create');  
           

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
        // standard fk Riles
        $rules->add($rules->existsIn(['lesson_id'], 'Lessons'));
        $rules->add($rules->existsIn(['lesson_edition_status_id'], 'LessonEditionStatuses'));
        $rules->add($rules->existsIn(['athlete_id'], 'Athletes'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        //check that lesson is active
        /*
        $rules->add(function($entity) use($rules) {
            if ($entity->lesson->is_active) {
                return true;
            }
            return 'Lesson is not active';
        }, 'lessonEdition', ['errorField' => 'N/A']);
        */

        $rules->addCreate(function($entity, $options) use($rules) {
            switch($entity->lesson_edition_status_id) {
                case Configure::read('lesson_edition_statuses')['draft']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['scheduled']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['booked']:
                    //a booked lesson edition must have an athlete and a user (trainer)
                    if (!$entity->athlete_id) {
                        // athlete must have an active subscription
                        return 'Missing athlete for a booked lesson';
                    }

                    if (!$entity->user_id) {
                        // user must be active and have the trainer role
                        return 'Missing trainer for a booked lesson';
                    }

                    if($entity->athlete->isBusy($entity->event->start_date, $entity->event->end_date, null)) {
                        return 'Athlete is busy';
                    }

                    if($entity->user->isBusy($entity->event->start_date, $entity->event->end_date, null)) {
                        return 'Trainer is busy';
                    }
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['completed']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['cancelled-staff']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['cancelled-athlete']:
                    return true;
                break;

                default;
                    debug('DEFAULT SWITCH CONDITION MET');
                    return 'Invalid lesson edition status';
                break;

            }
            return true;
        },
            'lessonEdtionCreate', ['errorField' => 'N/A']);

        $rules->addUpdate(function($entity, $options) use($rules) {

            switch($entity->lesson_edition_status_id) {
                case Configure::read('lesson_edition_statuses')['draft']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['booked']:

                    //a booked lesson edition must have an athlete and a user (trainer)
                    if (!$entity->athlete_id) {
                        // athlete must have an active subscription
                        return 'Missing athlete for a booked lesson';
                    }

                    if (!$entity->user_id) {
                        // user must be active and have the trainer role
                        return 'Missing trainer for a booked lesson';
                    }

                    if(isset($entity->athlete) && $entity->athlete->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event_id)) {
                        return 'Athlete is busy';
                    }

                    if(isset($entity->user) && $entity->user->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event_id)) {
                        return 'Trainer is busy';
                    }
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['completed']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['cancelled-staff']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['cancelled-athlete']:
                    return true;
                break;

                default;
                    debug('DEFAULT SWITCH CONDITION MET');
                    return 'Invalid lesson edition status';
                break;

            }
            return true;
        },
            'lessonEdtionUpdate', ['errorField' => 'N/A']);

        return $rules;
    }

    //marks lesson as completed, manages  bundle charges and status if any for the user
    public function complete($lesson_edition) {
        if ($lesson_edition->lesson_edition_status_id == Configure::read('lesson_edition_statuses')['booked']) {
            $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['completed'];
            //debug('Completing lesson edition: '.$lesson_edition->id);

            if (!empty($lesson_edition->athlete->valid_purchased_lesson_editions_bundles)) {

                //checking for bad things...
                if ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count == 0) {
                    return 'Il pacchetto di lezioni associato non ha cariche rimanenti, impossibile procedere. (se vedi questo messaggio, segnati bene cosa stavi facendo e chiama admin!)';
                }

                //Activation
                if ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->status == 1) {
                    $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->status = 2;
                    $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count = $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count - 1;
                    $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->start_date = Time::now();
                    $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->end_date = $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->start_date->modify('+'.$lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->lesson_editions_bundle->duration.' months');
                } else {
                    //change also status if Last charge
                    if ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count == 1 ) {
                        $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count = $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count - 1;
                        $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->status = 3;
                    } else {
                        $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count = $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->count - 1;
                    }               
                }
            }
            if ($this->save($lesson_edition, ['associated' => 'Athletes.ValidPurchasedLessonEditionsBundles'])) {
                return true;
            }
        }
        return 'false';
    }
}
