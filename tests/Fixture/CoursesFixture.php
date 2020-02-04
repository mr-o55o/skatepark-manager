<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CoursesFixture
 *
 */
class CoursesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'course_level_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'week_days' => ['type' => 'string', 'length' => 7, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'start_time' => ['type' => 'time', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'duration' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'price' => ['type' => 'float', 'length' => null, 'default' => '0.00', 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'course_status_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fki_course_levels_fk' => ['type' => 'index', 'columns' => ['course_level_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'course_levels_fk' => ['type' => 'foreign', 'columns' => ['course_level_id'], 'references' => ['course_levels', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'course_statuses_fk' => ['type' => 'foreign', 'columns' => ['course_status_id'], 'references' => ['course_statuses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'created' => 1578162802,
                'modified' => 1578162802,
                'name' => 'Lorem ipsum dolor sit amet',
                'course_level_id' => 1,
                'week_days' => 'Lorem',
                'start_time' => '19:33:22',
                'duration' => 1,
                'price' => 1,
                'course_status_id' => 1
            ],
        ];
        parent::init();
    }
}
