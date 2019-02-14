<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LessonEditionsFixture
 *
 */
class LessonEditionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => 'lessons_editions pk', 'precision' => null, 'unsigned' => null],
        'lesson_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => 'lessons fk', 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'start_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'lesson_status_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'ahtlete_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'althetes_fk' => ['type' => 'foreign', 'columns' => ['ahtlete_id'], 'references' => ['athletes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lessons_editions_fk' => ['type' => 'foreign', 'columns' => ['lesson_id'], 'references' => ['lessons', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'lessons_statuses_fk' => ['type' => 'foreign', 'columns' => ['lesson_status_id'], 'references' => ['lesson_statuses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'lesson_id' => 1,
                'start_date' => 1540571754,
                'lesson_status_id' => 1,
                'created' => 1540571754,
                'modified' => 1540571754,
                'ahtlete_id' => 1
            ],
        ];
        parent::init();
    }
}
