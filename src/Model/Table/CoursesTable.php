<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Database\Schema\TableSchema;
use Cake\Core\Configure;
/**
 * Courses Model
 *
 * @property \App\Model\Table\CourseLevelsTable|\Cake\ORM\Association\BelongsTo $CourseLevels
 * @property \App\Model\Table\CourseStatusesTable|\Cake\ORM\Association\BelongsTo $CourseStatuses
 * @property \App\Model\Table\CourseSessionsTable|\Cake\ORM\Association\HasMany $CourseSessions
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoursesTable extends Table
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

        $this->setTable('courses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseLevels', [
            'foreignKey' => 'course_level_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseStatuses', [
            'foreignKey' => 'course_status_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('CourseSubscriptions', [
            'foreignKey' => 'course_id'
        ]);

        $this->hasMany('CourseClasses', [
            'foreignKey' => 'course_id'
        ]);



    }

    protected function _initializeSchema(TableSchema $schema)
    {
        $schema->setColumnType('week_days', 'json');
        return $schema;
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        //$validator
            //->scalar('week_days')
            //->maxLength('week_days', 7)
            //->requirePresence('week_days', 'create')
            //->notEmpty('week_days');

        $validator
            ->time('start_time')
            ->requirePresence('start_time', 'create')
            ->notEmpty('start_time');

        $validator
            ->integer('duration')
            ->requirePresence('duration', 'create')
            ->notEmpty('duration');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

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
        $rules->add($rules->existsIn(['course_level_id'], 'CourseLevels'));
        $rules->add($rules->existsIn(['course_status_id'], 'CourseStatuses'));


        //regole da aggiungere 
        /*
        da draft a scheduled
        */

        /*
        da scheduled a active:
            - tutte le sue sessioni devono essere scheduled
        */
        $rules->add(
            function ($entity, $options) {
                if ($entity->isDirty('course_status_id') && $entity->course_status_id == Configure::read('course_statuses')['active']) {
                    $course_sessions_table = TableRegistry::getTableLocator()->get('CourseSessions');
                    $course_sessions = $course_sessions_table
                    ->find('all')
                    ->where(['course_id' => $entity->id])
                    ->count();

                    if($course_sessions == 0) {
                        return false;
                    }
                }
                return true;
            },
            'ruleName',
            [
                'errorField' => 'course_sessions',
                'message' => 'Cannot set course as Active. No sessions found.'
            ]
        );

        /*
        da active a completato:
            - tutte le sue sessioni devono essere completate o cancellate, almeno una completata
            - ci deve essere almeno un iscritto e deve aver pagato l'iscrizione
        */
        $rules->add(
            function ($entity, $options) {
                if ($entity->isDirty('course_status_id') && $entity->course_status_id == Configure::read('course_statuses')['completed']) {
                    $course_sessions_table = TableRegistry::getTableLocator()->get('CourseSessions');
                    $completed_course_sessions = $course_sessions_table
                    ->find('all')
                    ->where(['course_id' => $entity->id])
                    ->where(['course_session_status_id' => Configure::read('course_session_statuses')['completed']])
                    ->count();

                    $scheduled_course_sessions = $course_sessions_table
                    ->find('all')
                    ->where(['course_id' => $entity->id])
                    ->where(['course_session_status_id' => Configure::read('course_session_statuses')['scheduled']])
                    ->count();

                    debug('Completed sessions: '.$completed_course_sessions);
                    debug('Scheduled sessions: '.$scheduled_course_sessions);

                    if($completed_course_sessions == 0 || $scheduled_course_sessions > 0) {
                        return false;
                    }

                }
                return true;
            },
            'ruleName',
            [
                'errorField' => 'course_sessions',
                'message' => 'Cannot set course as completed, there are still some scheduled sessions or there are not completed sessions.'
            ]
        ); 

        $rules->add(
            function ($entity, $options) {
                if ($entity->isDirty('course_status_id') && $entity->course_status_id == Configure::read('course_statuses')['completed']) {
                    $course_subscriptions_table = TableRegistry::getTableLocator()->get('CourseSubscriptions');
                    $course_subscriptions = $course_subscriptions_table
                    ->find('all')
                    ->where(['course_id' => $entity->id])
                    ->count();

                    $unpaid_subscriptions = $course_subscriptions_table
                    ->find('all')
                    ->where(['course_id' => $entity->id])
                    ->where(['is_paid' => false])
                    ->count();

                    if($course_subscriptions == 0 || $unpaid_subscriptions > 0) {
                        return false;
                    }

                }
                return true;
            },
            'ruleName',
            [
                'errorField' => 'course_sessions',
                'message' => 'Cannot set course as completed, there no subscriptions or some of them do not result as being paied.'
            ]
        );       

         /*
        da active a cancellato:
        */

        //only courses in draft status are allowed to be deleted.
        $rules->addDelete(function($entity, $options) use($rules) {
            if ($entity->course_status_id <> Configure::read('course_statuses')['draft']) {
                return 'Deletion of a course not in draft status is not allowed.';
            }
            return true;            
        },
            'activityDelete', ['errorField' => 'course_status_id']);

        return $rules;
    }

    public function findDraft($query, $options)
    {
        $query->where(['course_status_id' => Configure::read('course_statuses')['draft']]);
        return $query;
    }

    public function findScheduled($query, $options)
    {
        $query->where(['course_status_id' => Configure::read('course_statuses')['scheduled']]);
        return $query;
    }

    public function findActive($query, $options)
    {
        $query->where(['course_status_id' => Configure::read('course_statuses')['active']]);
        return $query;
    }

    public function findCompleted($query, $options)
    {
        $query->where(['course_status_id' => Configure::read('course_statuses')['completed']]);
        return $query;
    }

    public function findCancelled($query, $options)
    {
        $query->where(['course_status_id' => Configure::read('course_statuses')['cancelled']]);
        return $query;
    }

    public function findSimilar($query, $options)
    {
        //debug($options);
        $price = $options['course']['price'];
        $id = $options['course']['id'];
        debug($id);
        $query->where(['course_status_id' => Configure::read('course_statuses')['scheduled']]);
        $query->orWhere(['course_status_id' => Configure::read('course_statuses')['active']]);
        $query->where(['id <>' => $id]);
        $query->where(['price' => $price]);
        return $query;
    }
}
