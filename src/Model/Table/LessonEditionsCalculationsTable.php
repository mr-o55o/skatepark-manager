<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonEditionsCalculations Model
 *
 * @method \App\Model\Entity\LessonEditionsCalculation get($primaryKey, $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonEditionsCalculation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LessonEditionsCalculationsTable extends Table
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

        $this->setTable('lesson_editions_calculations');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
}
