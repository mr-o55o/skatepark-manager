<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SelectedCourseEditions Model
 *
 * @property \App\Model\Table\CourseSubscriptionsTable|\Cake\ORM\Association\BelongsTo $CourseSubscriptions
 * @property \App\Model\Table\CourseEditionsTable|\Cake\ORM\Association\BelongsTo $CourseEditions
 *
 * @method \App\Model\Entity\SelectedCourseEdition get($primaryKey, $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SelectedCourseEdition findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SelectedCourseEditionsTable extends Table
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

        $this->setTable('selected_course_editions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseSubscriptions', [
            'foreignKey' => 'course_subscription_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CourseEditions', [
            'foreignKey' => 'course_edition_id',
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
        $rules->add($rules->existsIn(['course_edition_id'], 'CourseEditions'));

        return $rules;
    }
}
