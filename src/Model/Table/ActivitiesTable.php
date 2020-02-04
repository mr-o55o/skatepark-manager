<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\I18n\Time;
use Cake\Event\Event;
use ArrayObject;

/**
 * Activities Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ActivityTypesTable|\Cake\ORM\Association\BelongsTo $ActivityTypes
 *
 * @method \App\Model\Entity\Activity get($primaryKey, $options = [])
 * @method \App\Model\Entity\Activity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Activity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Activity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Activity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Activity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Activity findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ActivitiesTable extends Table
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

        $this->setTable('activities');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);

        $this->hasMany('ActivityUsers');


        $this->belongsTo('ActivityTypes', [
            'foreignKey' => 'activity_type_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('ActivityStatuses', [
            'foreignKey' => 'activity_status_id',
            'joinType' => 'LEFT'
        ]);

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);



        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'iLIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['ActivityUsers.Users.username', 'activity_users.user.username']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
            ]
        ); 
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
            ->allowEmpty('id', 'create')
            ->allowEmpty('activity_status_id', false, 'Select a status for the activity')
            ->integer('duration');

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
        //$rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['activity_type_id'], 'ActivityTypes'));
        $rules->add($rules->existsIn(['activity_status_id'], 'ActivityStatuses'));

        //only activities ind draft status are allowed to be deleted.
        $rules->addDelete(function($entity, $options) use($rules) {
            if ($entity->activity_status_id <> Configure::read('activity_statuses')['draft']) {
                return 'Deletion of an activity not in draft status is not allowed.';
            }
            return true;            
        },
            'activityDelete', ['errorField' => 'activity_status_id']);

        //activities are created in draft status
        $rules->addCreate(function($entity, $options) use($rules) {
            if ($entity->activity_status_id <> Configure::read('activity_statuses')['draft']) {
                return 'A new activity must be in draft status';
            }
            return true;
        },
            'activityCreate', ['errorField' => 'activity-create']);

        //a new activity has an associated event
        $rules->add(function($entity, $options) use($rules) {
            if ($entity->isEmpty('event')) {
                return false;
            }
            return true;
        },
            'activityCreate', ['errorField' => 'event', 'message' => 'A new activity must have an associated event']); 

        // a new activity always starts in the future
        $rules->addCreate(function($entity, $options) use($rules) {
            if ($entity->event->start_date < Time::now()) {
                return false;
            }
            return true;
        },
            'activity', ['errorField' => 'event.start_date', 'message' => 'Activity must start in the future.']); 

        //activities must end in the same day they started
        $rules->add(function($entity, $options) use($rules) {
            if ($entity->event->start_date->i18nFormat('YYYYMMdd') != $entity->event->end_date->i18nFormat('YYYYMMdd')) {
                return false;
            }
            return true;
        },
            'activity', ['errorField' => 'event.end_date', 'message' => 'Activity must end in the same day in which it started.']); 

        //associated event cannot be modified
        $rules->addUpdate(function($entity, $options) use($rules) {
            if ($entity->event->isDirty()) {
                return false;
            }
            return true;
        },
            'activityCreate', ['errorField' => 'event', 'message' => 'Cannot modify the associated event of an existing activity.']);  

        // associated users cannot be busy in other activities for a scheduled activity
        $rules->addUpdate(function($entity, $options) use($rules) {
            if ($entity->activity_status_id == Configure::read('scheduled')) {
                foreach($entity->activity_users as $activity_user) {
                    if ($activity_user->user->isBusy($entity->event->start_date, $entity->event->end_date, $entity->event->id)) {
                        debug('found a busy user: '.$activity_user->user->username);
                        return 'User '.$activity_user->user->username.' is busy in this activity timeframe.';
                    }
                }               
            }
            return true;
        },
            'activityUpdate', ['errorField' => 'activity_users']);      

        // checks based on activity status
        $rules->addUpdate(function($entity, $options) use($rules) {

            //debug('Original status: '.$entity->getOriginal('activity_status_id'));
            //debug('Current status: '.$entity->activity_status);
            if ($entity->getOriginal('activity_status_id') != $entity->activity_status_id) {
                //debug('status has changed, perform some checks');
                switch ($entity->getOriginal('activity_status id')) {
                    case Configure::read('activity_statuses')['draft']:
                    if ($entity->activity_status_id != 2) {
                        return 'Status not valid, activities in draft status can only become scheduled';
                    }
                    break;

                    case Configure::read('activity_statuses')['scheduled']:
                    if ($entity->activity_status_id != 3 or $entity->activity_status_id != 4) {
                        return 'Status not valid for a scheduled activity';
                    }
                    break;

                    case Configure::read('activity_statuses')['completed']:
                        return 'Cannot change status of a completed activity.';
                    break;

                    case Configure::read('activity_statuses')['cancelled']:
                        return 'Cannot change status of a cancelled activity.';
                    break;
                }
            }
            return true;
        },
            'activityUpdate', ['errorField' => 'activity_status', 'message' => 'Status not valid.']);

        return $rules;
    }

    public function findScheduled($query, $options) {
        $query->where(['activity_status_id' => Configure::read('activity_statuses')['scheduled']]);
        return $query;
    }
}
