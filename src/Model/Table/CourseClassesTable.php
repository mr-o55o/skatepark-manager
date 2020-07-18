<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseClasses Model
 *
 * @property \App\Model\Table\CoursePeriodsTable|\Cake\ORM\Association\BelongsTo $CoursePeriods
 * @property \App\Model\Table\CourseEditionsTable|\Cake\ORM\Association\BelongsTo $CourseEditions
 * @property \App\Model\Table\CourseClassStatusesTable|\Cake\ORM\Association\BelongsTo $CourseClassStatuses
 * @property \App\Model\Table\CourseClassMembersTable|\Cake\ORM\Association\HasMany $CourseClassMembers
 *
 * @method \App\Model\Entity\CourseClass get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseClass newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseClass[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseClass|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseClass|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseClass patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseClass[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseClass findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseClassesTable extends Table
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

        $this->setTable('course_classes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CoursePeriods', [
            'foreignKey' => 'course_period_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseEditions', [
            'foreignKey' => 'course_edition_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseClassStatuses', [
            'foreignKey' => 'course_class_status_id'
        ]);
        $this->hasMany('CourseClassMembers', [
            'foreignKey' => 'course_class_id'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['course_period_id'], 'CoursePeriods'));
        $rules->add($rules->existsIn(['course_edition_id'], 'CourseEditions'));
        $rules->add($rules->existsIn(['course_class_status_id'], 'CourseClassStatuses'));

        return $rules;
    }
}
