<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseClassMembers Model
 *
 * @property \App\Model\Table\CourseSubscriptionsTable|\Cake\ORM\Association\BelongsTo $CourseSubscriptions
 * @property \App\Model\Table\CourseClassesTable|\Cake\ORM\Association\BelongsTo $CourseClasses
 *
 * @method \App\Model\Entity\CourseClassMember get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseClassMember newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseClassMember[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseClassMember|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseClassMember|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseClassMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseClassMember[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseClassMember findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseClassMembersTable extends Table
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

        $this->setTable('course_class_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseSubscriptions', [
            'foreignKey' => 'course_subscription_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseClasses', [
            'foreignKey' => 'course_class_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['course_subscription_id'], 'CourseSubscriptions'));
        $rules->add($rules->existsIn(['course_class_id'], 'CourseClasses'));

        return $rules;
    }
}
