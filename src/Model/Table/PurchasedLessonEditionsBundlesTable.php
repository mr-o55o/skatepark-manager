<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Core\Configure;

/**
 * PurchasedLessonEditionsBundles Model
 *
 * @property \App\Model\Table\AthletesTable|\Cake\ORM\Association\BelongsTo $Athletes
 * @property \App\Model\Table\LessonEditionsBundlesTable|\Cake\ORM\Association\BelongsTo $LessonEditionsBundles
 *
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchasedLessonEditionsBundlesTable extends Table
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

        $this->setTable('purchased_lesson_editions_bundles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Athletes', [
            'foreignKey' => 'athlete_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LessonEditionsBundles', [
            'foreignKey' => 'lesson_editions_bundle_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('PurchasedLessonEditionsBundlesStatuses', [
            'foreignKey' => 'status',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'iLIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['Athletes.name', 'Athletes.surname']
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }
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
            ->boolean('is_activated')
            ->requirePresence('is_activated', 'create')
            ->notEmpty('is_activated');

        $validator
            ->date('start_date');
            //->requirePresence('start_date', 'create')
            //->notEmpty('start_date');

        $validator
            ->date('end_date');
            //->requirePresence('end_date', 'create')
            //->notEmpty('end_date');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['athlete_id'], 'Athletes'));
        $rules->add($rules->existsIn(['lesson_editions_bundle_id'], 'LessonEditionsBundles'));
        
        $rules->addCreate(function($entity) use($rules) {
            $validBundlesCount = $this->find('valid')->where(['athlete_id' => $entity->athlete_id, 'lesson_editions_bundle_id' => $entity->lesson_editions_bundle_id])->count();

            if ($validBundlesCount > 0) {
                return false;
            }
            return true;
        }, ['errorField' => 'sameBundleAlreadyAssigned', 'message' => 'Athlete has already a valid bundle of this type, operation not permitted']);
        
        return $rules;
    }

    public function findValid(Query $query) {
        $now = Time::now();
        //to-do map status in configuration
        $query->where(['status' => Configure::read('purchased_lesson_editions_bundle_statuses')['purchased']], ['end_date <' => $now, ]);
        $query->orWhere(['status' => Configure::read('purchased_lesson_editions_bundle_statuses')['activated']]);

        return $query;
    }

    public function findWithAthlete(Query $query, $options)
    {
         $query->where(['athlete_id' => $options['athlete_id']]);
        return $query;       
    }
}
