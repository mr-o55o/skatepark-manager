<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CourseSessionPartecipants Model
 *
 * @property \App\Model\Table\CourseSessionsTable|\Cake\ORM\Association\BelongsTo $CourseSessions
 * @property \App\Model\Table\AthletesTable|\Cake\ORM\Association\BelongsTo $Athletes
 *
 * @method \App\Model\Entity\CourseSessionPartecipant get($primaryKey, $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CourseSessionPartecipant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourseSessionPartecipantsTable extends Table
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

        $this->setTable('course_session_partecipants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CourseSessions', [
            'foreignKey' => 'course_session_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Athletes', [
            'foreignKey' => 'athlete_id',
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
        $rules->add($rules->existsIn(['course_session_id'], 'CourseSessions'));
        $rules->add($rules->existsIn(['athlete_id'], 'Athletes'));

        return $rules;
    }
}
