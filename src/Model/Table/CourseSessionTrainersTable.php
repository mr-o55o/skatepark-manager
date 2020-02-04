<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSessionTrainers Model
 *
 * @property \App\Model\Table\CourseSessionsTable|\Cake\ORM\Association\BelongsTo $CourseSessions
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CourseSessionTrainer get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSessionTrainer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseSessionTrainersTable extends Table
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

        $this->setTable('course_session_trainers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseSessions', [
            'foreignKey' => 'course_session_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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

        $validator
            ->scalar('notes')
            ->allowEmpty('notes');

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
        $rules->add($rules->existsIn(['course_session_id'], 'CourseSessions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
