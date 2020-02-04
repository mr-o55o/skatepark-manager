<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
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
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('LessonEditionStatuses', [
            'foreignKey' => 'lesson_edition_status_id',
            'joinType' => 'LEFT'
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
            ]
        );     

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

    public function findDraft($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['draft']]);
        return $query;
    }

    public function findTrainerAssigned($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['trainer-assigned']]);
        return $query;
    }

    public function findCancelled($query, $options)
    {
        $query->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['cancelled-staff']]);
        $query->orWhere(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['cancelled-athlete']]);
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

        //only eiditions in draft status are allowed to be deleted.
        $rules->addDelete(function($entity, $options) use($rules) {
            if ($entity->lesson_edition_id <= Configure::read('lesson_edition_statuses')['trainer-assigned']) {
                return 'Deletion of a lesson edition not in draft status is not allowed.';
            }
            return true;            
        },
            'lessonEditionDelete', ['errorField' => 'activity_status_id']);
/*
        //associated event cannot be modified
        $rules->addUpdate(function($entity, $options) use($rules) {
            if ($entity->event->isDirty('start_date')) {
                return false;
            }
            return true;
        },
            'lessonEditionCreate', ['errorField' => 'event', 'message' => 'Cannot modify the associated event of an existing lesson_edition.']);
*/
        // a lessonEdition always starts in the future
        $rules->addCreate(function($entity, $options) use($rules) {
            if ($entity->event->start_date < Time::now()) {
                return false;
            }
            return true;
        },
            'lessonEditionStartDate', ['errorField' => 'event.start_date', 'message' => 'Lesson Edition must start in the future.']);

        //a new activity has an associated event
        $rules->add(function($entity, $options) use($rules) {
            if ($entity->isEmpty('event')) {
                return false;
            }
            return true;
        },
            'lessonEditionCreate', ['errorField' => 'event', 'message' => 'A lesson_edition must have an associated event']); 

        //lesson_editions must end in the same day they started
        $rules->add(function($entity, $options) use($rules) {
            if ($entity->event->start_date->day != $entity->event->end_date->day) {
                return false;
            }
            return true;
        },
            'lessonEdition', ['errorField' => 'event.end_date', 'message' => 'Lesson Editions must end in the same day in which it started.']); 
        /*
        // associated users cannot be busy in other activities
        $rules->addUpdate(function($entity, $options) use($rules) {
            if ($entity->lesson_edition_status_id == Configure::read('booked')) {
                if($entity->has('user')) {
                    if ($entity->user->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event->id)) {
                        return 'User '.$entity->user->username.' is busy in this activity timeframe.';
                    }               
                }
            }
            return true;
        },
            'lessonEditionUpdate', ['errorField' => 'user_id']); 
        */
        /*
        // associated athlete cannot be busy in other activities
        $rules->addUpdate(function($entity, $options) use($rules) {
            if ($entity->lesson_edition_status_id == Configure::read('booked')) {
                if($entity->has('athlete')) {
                    if ($entity->athlete->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event->id)) {
                        return 'Athlete '.$entity->athlete->name.' '.$entity->athlete->surname.' is busy in this activity timeframe.';
                    }               
                }
            }
            return true;
        },
            'lessonEditionUpdate', ['errorField' => 'user_id']);
        */

        $rules->add(function($entity, $options) use($rules) {

            switch($entity->lesson_edition_status_id) {
                case Configure::read('lesson_edition_statuses')['draft']:
                    return true;
                break;

                case Configure::read('lesson_edition_statuses')['trainer-assigned']:
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
                    if($entity->athlete->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event->id)) {
                        return 'Athlete is busy';
                    }

                    if($entity->user->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event->id)) {
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
            'lessonEdtion', ['errorField' => 'N/A']);

        // checks based on activity status
        $rules->addUpdate(function($entity, $options) use($rules) {
            if ($entity->getOriginal('lesson_edition_status_id') != $entity->lesson_edition_status_id) {
                //debug('status has changed, perform some checks');
                switch ($entity->getOriginal('lesson_edition_status id')) {
                    case Configure::read('lesson_edition_statuses')['draft']:
                    if ($entity->activity_status_id > Configure::read('lesson_edition_statuses'['trainer-assigned'])) {
                        return 'Status not valid, lesson editions in draft status can only become booked or trainer-assigned';
                    }
                    break;

                    case Configure::read('lesson_edition_statuses')['booked']:
                    if ($entity->lesson_edition_status_id != Configure::read('lesson_edition_statuses')['completed'] or $entity->lesson_edition_status_id != Configure::read('lesson_edition_statuses')['cancelled-staff'] or $entity->lesson_edition_status_id != Configure::read('lesson_edition_statuses')['cancelled-athlete']) {
                        return 'A booked edition can only become completed or cancelled';
                    }
                    break;

                    case Configure::read('lesson_edition_statuses')['completed']:
                        return 'Cannot change status of a completed edition.';
                    break;

                    case Configure::read('lesson_edition_statuses')['cancelled-staff']:
                        return 'Cannot change status of a cancelled edition.';
                    break;

                    case Configure::read('lesson_edition_statuses')['cancelled-athlete']:
                        return 'Cannot change status of a cancelled edition.';
                    break;
                }
            }
            return true;
        },
            'activityUpdate', ['errorField' => 'activity_status', 'message' => 'Status not valid.']);

        return $rules;

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

                    $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[0]->start_date = FrozenTime::now();
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
        } else {
            debug('error in complete method');
            return false;
        }
    }



    //save a moltidue of lesson editions in a given period of time
    public function createDrafts($start_date, $end_date, $daily_start_hour, $daily_end_hour, array $weekdays, $lesson_id)
    {
        $current_start_hour = $daily_start_hour;
        $current_end_hour = $daily_end_hour;
        $current_date = new FrozenTime($start_date->startOfDay());
        $end_date = $end_date->endOfDay();

        $lesson = TableRegistry::getTableLocator()->get('Lessons')->get($lesson_id);
        $savedEditions = [];
        $errorEditions = [];
        $editionsCounter = 0;

        //debug('Creating lesson editions between '. $start_date . ' and ' . $end_date);
        while ( $current_date->i18nFormat('YYYYMMdd') <=  $end_date->i18nFormat('YYYYMMdd') ) {
            //debug('Trying to add lesson editions for day: '.$current_date);

            //check weekdays
            if ( in_array($current_date->dayOfWeek, $weekdays) ) {
                //debug('Weekday match found');
                $current_start_hour = $daily_start_hour;
                
                while ( ($current_start_hour + $lesson->duration / 60 ) <= $daily_end_hour ) {
                    //debug('Working on lessons editions starting at: '.$current_start_hour);
                    $event_start_date = $current_date->modify('+' . $current_start_hour .' hours');
                    //debug('Event start_date1: ' . $event_start_date);
                    $event_end_date = $current_date->modify('+ '. $current_start_hour .' hours')->modify('+ '.$lesson->duration .' minutes');
                    //debug('Event end_date: ' . $event_end_date);
                    //debug('find Free Trainers');
                    $trainers =  TableRegistry::getTableLocator()->get('Users')->find('free', ['start_date' => $event_start_date, 'end_date' => $event_end_date, 'exclude' => null])->where(['role_id' => Configure::read('roles')['trainer']]);
                    //debug('Free Trainers found: '.$trainers->count());

                    //debug('Event start_date: ' . $event_start_date);
                    foreach ( $trainers as $trainer) {
                        //debug('Create Lesson edition for trainer: '.$trainer->username);
                        //debug($event_start_date);
                        //event entity
                        $event = TableRegistry::getTableLocator()->get('Events')->newEntity();
                        //debug($event);
                        //debug('start_Date: '.$event_start_date);
                        $event->start_date = $event_start_date;
                        $event->end_date = $event_end_date;
                        //debug('$event->start_date: '.$event->start_date);
                        $event->title = 'Lesson Edition created by wizard';
                        //debug($event);
                        //lesson_entity
                        $lesson_edition = $this->newEntity();
                        $lesson_edition->event = $event;
                        //debug('$lesson_edition->event->start_date:'. $lesson_edition->event->start_date);
                        $lesson_edition->user = $trainer;
                        $lesson_edition->lesson_id = $lesson->id;
                        $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['trainer-assigned'];
                        //save lesson
                        if ( $this->save($lesson_edition) ) {
                            //debug('Lesson edition saved');
                            $savedEditions[$editionsCounter] = $lesson_edition;
                        } else {
                            //debug('Error saving lesson edion');
                            $errorEditions[$editionsCounter] = $lesson_edition;
                        }
                        $editionsCounter++; 
                    }
                    $current_start_hour++;
                    //debug('Updated current_start_hour: '.$current_start_hour);
                }
            }
            
            //debug('Current date: '. $current_date);
            $current_date = $current_date->modify('+ 1 day');
            //debug('New Current date: '. $current_date);
        }
        //debug('End of operations');
        return ['savedEditions' => $savedEditions, 'errorEditions' => $errorEditions];
    }

    public function book($lesson_edition)
    {
        //debug('Edition is bookable?:'.$lesson_edition->isBookable());
        if ($lesson_edition->isBookable() === true) {
            //set booked status
            debug('setting booked status');
            $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['booked']; 
            if ($this->save($lesson_edition)) {
                return true;
            } else {
                //debug($lesson_edition->getErrors());
                return false;
            }
        } else {
            debug('Lesson Edition is not bookable');
            return $lesson_edition->isBookable();
        }
    }
}
