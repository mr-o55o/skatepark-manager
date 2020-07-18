<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CourseSubscriptionsWeekDaysFixture
 *
 */
class CourseSubscriptionsWeekDaysFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'course_subscription_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'course_week_day_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'course_subscription_course_subscription_week_days_fk' => ['type' => 'foreign', 'columns' => ['course_subscription_id'], 'references' => ['course_subscriptions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'course_subscription_week_days_course_week_days_fk' => ['type' => 'foreign', 'columns' => ['course_week_day_id'], 'references' => ['course_week_days', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'course_subscription_id' => 1,
                'course_week_day_id' => 1,
                'created' => 1581785215,
                'modified' => 1581785215
            ],
        ];
        parent::init();
    }
}
