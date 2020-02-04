<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
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
        $this->hasMany('CourseSessions', [
            'foreignKey' => 'course_id'
        ]);
        $this->hasMany('CourseSubscriptions', [
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
}
