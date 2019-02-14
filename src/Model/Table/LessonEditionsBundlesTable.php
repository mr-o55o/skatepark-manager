<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LessonEditionsBundles Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Lessons
 * @property \App\Model\Table\PurchasedLessonEditionsBundlesTable|\Cake\ORM\Association\HasMany $PurchasedLessonEditionsBundles
 *
 * @method \App\Model\Entity\LessonEditionsBundle get($primaryKey, $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LessonEditionsBundle findOrCreate($search, callable $callback = null, $options = [])
 */
class LessonEditionsBundlesTable extends Table
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

        $this->setTable('lesson_editions_bundles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Lessons', [
            'foreignKey' => 'lesson_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PurchasedLessonEditionsBundles', [
            'foreignKey' => 'lesson_editions_bundle_id'
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
            ->scalar('name')
            ->maxLength('name', 60)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->integer('lesson_edition_count')
            ->requirePresence('lesson_edition_count', 'create')
            ->notEmpty('lesson_edition_count');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

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
        $rules->add($rules->existsIn(['lesson_id'], 'Lessons'));

        return $rules;
    }
}
