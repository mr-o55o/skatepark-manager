<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \App\Model\Table\LessonEditionsTable|\Cake\ORM\Association\BelongsTo $LessonEditions
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Calendar.Calendar', [
            'field' => 'start_date',
            'endField' => 'end_date',
            //'scope' => ['invisible' => false],
        ]);
        /* Experimental
        $this->addBehavior('WeeklyCalendar', [
            'field' => 'start_date',
            'endField' => 'end_date',
            //'scope' => ['invisible' => false],
        ]);
        */
        $this->hasOne('LessonEditions', [
                //'dependent' => true,
                //'cascadeCallbacks' => true,
        ]);

        $this->hasOne('Activities', [
                //'dependent' => true,
                //'cascadeCallbacks' => true,
        ]);

        $this->hasOne('CourseSessions', [
                //'dependent' => true,
                //'cascadeCallbacks' => true,
        ]);
    }


    public function findInDay(Query $query, $options) {
        //$options['day'];
        $start = $options['day']->startOfDay();
        $end = $options['day']->endOfDay();
        $query->contain(['LessonEditions', 'Activities', 'CourseSessions']);
        $query->where(['start_date >=' => $start]);
        $query->andWhere( ['end_date <=' => $end]);
        $query->order(['start_date']);
        return $query;



    }

    public function findBetween(Query $query, $options) {
        $query->contain(['LessonEditions.LessonEditionStatuses', 'LessonEditions.Lessons', 'LessonEditions.Athletes', 'LessonEditions.Users', 'Activities.ActivityStatuses', 'Activities.ActivityUsers.Users', 'Activities.ActivityTypes']);
        $query->where(['start_date >=' => $options['from']]);
        $query->where(['start_date <=' => $options['to']]);

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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('description')
            ->allowEmpty('description');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

         $validator->add('end_date', 'custom', [
            'rule' => function ()  {
                if ($this->data['start_date'] == $this->data['start_date']) {
                    return false;
                }
                return true;
            },
            'message' => 'The title is not valid'
        ]);       

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
        //$rules->add($rules->existsIn(['lesson_edition_id'], 'LessonEditions'));
        //$rules->add($rules->existsIn(['activity_id'], 'Activities'));



        return $rules;
    }
}
