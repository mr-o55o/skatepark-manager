<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseWeekDaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseWeekDaysTable Test Case
 */
class CourseWeekDaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseWeekDaysTable
     */
    public $CourseWeekDays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_week_days',
        'app.course_subscription_week_days'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseWeekDays') ? [] : ['className' => CourseWeekDaysTable::class];
        $this->CourseWeekDays = TableRegistry::getTableLocator()->get('CourseWeekDays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseWeekDays);

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
}
