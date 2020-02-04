<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CourseSessionPartecipantsFixture
 *
 */
class CourseSessionPartecipantsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'course_session_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'athlete_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'fki_course_session_partecipants_subscriptions_fk' => ['type' => 'index', 'columns' => ['athlete_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'course_session_partecipanrs_sessions_fk' => ['type' => 'foreign', 'columns' => ['course_session_id'], 'references' => ['course_sessions', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'course_session_partecipants_subscriptions_fk' => ['type' => 'foreign', 'columns' => ['athlete_id'], 'references' => ['athletes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'course_session_id' => 1,
                'athlete_id' => 1,
                'created' => 1578162868,
                'modified' => 1578162868
            ],
        ];
        parent::init();
    }
}
