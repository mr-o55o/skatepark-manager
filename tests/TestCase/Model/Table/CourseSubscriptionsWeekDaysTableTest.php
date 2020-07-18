<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseSubscriptionsWeekDaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseSubscriptionsWeekDaysTable Test Case
 */
class CourseSubscriptionsWeekDaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseSubscriptionsWeekDaysTable
     */
    public $CourseSubscriptionsWeekDays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_subscriptions_week_days',
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
        $config = TableRegistry::getTableLocator()->exists('CourseSubscriptionsWeekDays') ? [] : ['className' => CourseSubscriptionsWeekDaysTable::class];
        $this->CourseSubscriptionsWeekDays = TableRegistry::getTableLocator()->get('CourseSubscriptionsWeekDays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseSubscriptionsWeekDays);

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
