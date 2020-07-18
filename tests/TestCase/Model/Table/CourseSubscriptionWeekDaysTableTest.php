<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseSubscriptionWeekDaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseSubscriptionWeekDaysTable Test Case
 */
class CourseSubscriptionWeekDaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseSubscriptionWeekDaysTable
     */
    public $CourseSubscriptionWeekDays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_subscription_week_days',
        'app.course_subscriptions',
        'app.course_week_days'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseSubscriptionWeekDays') ? [] : ['className' => CourseSubscriptionWeekDaysTable::class];
        $this->CourseSubscriptionWeekDays = TableRegistry::getTableLocator()->get('CourseSubscriptionWeekDays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseSubscriptionWeekDays);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
