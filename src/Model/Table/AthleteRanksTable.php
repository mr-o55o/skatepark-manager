<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AthleteRanks Model
 *
 * @property \App\Model\Table\AthletesTable|\Cake\ORM\Association\HasMany $Athletes
 *
 * @method \App\Model\Entity\AthleteRank get($primaryKey, $options = [])
 * @method \App\Model\Entity\AthleteRank newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AthleteRank[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AthleteRank|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AthleteRank|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AthleteRank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AthleteRank[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AthleteRank findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AthleteRanksTable extends Table
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

        $this->setTable('athlete_ranks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Athletes', [
            'foreignKey' => 'athlete_rank_id'
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
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('rank')
            ->allowEmpty('rank');

        return $validator;
    }
}
