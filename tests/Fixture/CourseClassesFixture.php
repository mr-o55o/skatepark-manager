<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CourseClassesFixture
 *
 */
class CourseClassesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'name' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => false, 'collate' => null, 'comment' => null, 'precision' => null, 'fixed' => null],
        'course_period_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'course_edition_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'course_class_status_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'course_edition_course_period_unique' => ['type' => 'unique', 'columns' => ['course_period_id', 'course_edition_id'], 'length' => []],
            'course_classes_course_class_statuses_fk' => ['type' => 'foreign', 'columns' => ['course_class_status_id'], 'references' => ['course_class_statuses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'course_classes_course_editions_fk' => ['type' => 'foreign', 'columns' => ['course_edition_id'], 'references' => ['course_editions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'course_periods_course_classes_fk' => ['type' => 'foreign', 'columns' => ['course_period_id'], 'references' => ['course_periods', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'name' => 'Lorem ipsum dolor sit amet',
                'course_period_id' => 1,
                'created' => 1583064534,
                'modified' => 1583064534,
                'course_edition_id' => 1,
                'course_class_status_id' => 1,
                'id' => 1
            ],
        ];
        parent::init();
    }
}
