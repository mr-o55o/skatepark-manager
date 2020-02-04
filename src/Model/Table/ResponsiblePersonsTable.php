<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use CodiceFiscale\Validator as CfValidator;

use Cake\i18n\Time;

/**
 * ResponsiblePersons Model
 *
 * @property \App\Model\Table\AthletesTable|\Cake\ORM\Association\HasMany $Athletes
 *
 * @method \App\Model\Entity\ResponsiblePerson get($primaryKey, $options = [])
 * @method \App\Model\Entity\ResponsiblePerson newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ResponsiblePerson[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ResponsiblePerson|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResponsiblePerson|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ResponsiblePerson patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ResponsiblePerson[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ResponsiblePerson findOrCreate($search, callable $callback = null, $options = [])
 */

class ResponsiblePersonsTable extends Table
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

        $this->setTable('responsible_persons');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Search.Search');

        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'iLIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['name', 'surname', 'email']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
            ]);

        $this->hasMany('Athletes', [
            'foreignKey' => 'responsible_person_id'
        ]);

        $this->belongsTo('Provinces', [
            'birth_province' => array(
                'className' => 'Provinces',
                'foreignKey' => 'birth_province_code'
            ),
            'living_province' => array(
                 'className' => 'Provinces',
                 'foreignKey' => 'province_code'
            )
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
            ->maxLength('name', 50)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('surname')
            ->maxLength('surname', 50)
            ->requirePresence('surname', 'create')
            ->notEmpty('surname');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->scalar('fiscal_code')
            ->maxLength('fiscal_code', 16)
            ->requirePresence('fiscal_code', 'create')
            ->notEmpty('fiscal_code')
            ->add('fiscal_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('birth_date')
            ->requirePresence('birth_date', 'create')
            ->notEmpty('birth_date');

        $validator
            ->requirePresence('birth_city', 'create')
            ->notEmpty('birth_city');

        $validator
            ->notEmpty('birth_city');

        $validator
            ->notEmpty('birth_province_code');

        $validator
            ->notEmpty('city');

        $validator
            ->notEmpty('province_code');

        $validator
            ->notEmpty('postal_code');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['fiscal_code']));

        $rules->add($rules->existsIn(['birth_province_code'], 'Provinces'));
        $rules->add($rules->existsIn(['province_code'], 'Provinces'));

        $rules->addCreate(function($entity) {
            $cfValidator = new CfValidator($entity->fiscal_code);
            return $cfValidator->isFormallyValid();
        }, 'fiscalCodeFormalCheck', ['errorField' => 'fiscal_code', 'message' => 'Formal validation of fiscal code failed']);

        $rules->addUpdate(function($entity) {
            $cfValidator = new CfValidator($entity->fiscal_code);
            return $cfValidator->isFormallyValid();
        }, 'fiscalCodeFormalCheck', ['errorField' => 'fiscal_code', 'message' => 'Formal validation of fiscal code failed']);

        //A responsible person must be more than 18
        $rules->add(function($entity) {
            if ($entity->birth_date->diffInYears(Time::now()) < 18) {
                return false;
            }
            return true;        
        }, 'responsiblePersonAgeCheck', ['errorField' => 'birth_date', 'message' => 'A responsible person cannot be less than 18.']

        );

        return $rules;
    }


    public function findBySurname(Query $query, $options)
    {   
        $query->Where(['surname iLike' => '%'.$options['search'].'%']);
        return $query;
    }
}
