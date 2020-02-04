<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSessions Model
 *
 * @property \App\Model\Table\CourseStatusesTable|\Cake\ORM\Association\BelongsTo $CourseStatuses
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\CoursesTable|\Cake\ORM\Association\BelongsTo $Courses
 * @property \App\Model\Table\CourseSessionPartecipantsTable|\Cake\ORM\Association\HasMany $CourseSessionPartecipants
 *
 * @method \App\Model\Entity\CourseSession get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSession newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSession[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSession|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSession|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSession[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSession findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseSessionsTable extends Table
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

        $this->setTable('course_sessions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseSessionStatuses', [
            'foreignKey' => 'course_session_status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CourseSessionPartecipants', [
            'foreignKey' => 'course_session_id'
        ]);
        $this->hasMany('CourseSessionTrainers', [
            'foreignKey' => 'course_session_id'
        ]);
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
        $rules->add($rules->existsIn(['course_status_id'], 'CourseSessionStatuses'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));
        return $rules;
    }
}
