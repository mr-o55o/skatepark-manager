<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PurchasedLessonEditionsBundlesFixture
 *
 */
class PurchasedLessonEditionsBundlesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'athlete_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'lesson_editions_bundle_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'is_active' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'start_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'end_date' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'athletes_purchased_lesson_editions_bundles_fk' => ['type' => 'foreign', 'columns' => ['athlete_id'], 'references' => ['athletes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lesson_editions_bundles_purchased_lessons_editions_bundles_fk' => ['type' => 'foreign', 'columns' => ['lesson_editions_bundle_id'], 'references' => ['lesson_editions_bundles', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'athlete_id' => 1,
                'lesson_editions_bundle_id' => 1,
                'is_active' => 1,
                'start_date' => 1550001089,
                'end_date' => 1550001089
            ],
        ];
        parent::init();
    }
}
