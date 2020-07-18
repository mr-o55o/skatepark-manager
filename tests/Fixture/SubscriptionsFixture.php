<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubscriptionsFixture
 *
 */
class SubscriptionsFixture extends TestFixture
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
        'created' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'is_paid' => ['type' => 'boolean', 'length' => null, 'default' => 0, 'null' => false, 'comment' => null, 'precision' => null],
        'start_date' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'end_date' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null],
        'subscription_status_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'subscription_type_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fki_subscriptions_subscription_statuses_fk' => ['type' => 'index', 'columns' => ['subscription_status_id'], 'length' => []],
            'fki_subscriptions_subscription_types_fk' => ['type' => 'index', 'columns' => ['subscription_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'subscriptions_athletes_fk' => ['type' => 'foreign', 'columns' => ['athlete_id'], 'references' => ['athletes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'subscriptions_subscription_statuses_fk' => ['type' => 'foreign', 'columns' => ['subscription_status_id'], 'references' => ['subscription_statuses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'subscriptions_subscription_types_fk' => ['type' => 'foreign', 'columns' => ['subscription_type_id'], 'references' => ['subscription_types', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'created' => 1583577819,
                'modified' => 1583577819,
                'is_paid' => 1,
                'start_date' => '2020-03-07',
                'end_date' => '2020-03-07',
                'subscription_status_id' => 1,
                'subscription_type_id' => 1
            ],
        ];
        parent::init();
    }
}
