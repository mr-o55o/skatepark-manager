<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;

/**
 * UsersAvailability Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UsersAvailability get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersAvailability newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersAvailability[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersAvailability|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersAvailability|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersAvailability patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersAvailability[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersAvailability findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersAvailabilityTable extends Table
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

        $this->setTable('users_availability');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Calendar.Calendar', [
            'field' => 'start_date',
            'endField' => 'end_date',
            //'scope' => ['invisible' => false],
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        // A list of fields
        $rules->add($rules->isUnique(
            ['user_id', 'start_date', 'end_date'],
            'user has already an entry with the same start and end dates, operation not permitted.'
        ));

        return $rules;
    }

    public function findInDay(Query $query, $options) {
        $query->contain(['Users']);
        $query->where(['start_date' => $options['day']->startOfDay()]);
        return $query;
    }

    public function deleteTransactional($usersAvailability) {
        if ($this->delete($usersAvailability)) {
            $lessonEditions = TableRegistry::getTableLocator()->get("LessonEditions")->query()
            ->update()
            ->set(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['draft']])
            ->where(['user_id' => $usersAvailability->id])
            ->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['trainer-assigned']])
            ->matching('Events', function(\Cake\ORM\Query $q) use ($usersAvailability) {
                return $q->where(['Events.start_date >=' => $usersAvailability->start_date])->where(['Events.end_date >=' => $usersAvailability->end_date]);
            })
            ->execute();
            return true;
        } else {
            return false;
        }     
    }
}
