<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CoursePeriodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CoursePeriodsTable Test Case
 */
class CoursePeriodsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CoursePeriodsTable
     */
    public $CoursePeriods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_periods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CoursePeriods') ? [] : ['className' => CoursePeriodsTable::class];
        $this->CoursePeriods = TableRegistry::getTableLocator()->get('CoursePeriods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CoursePeriods);

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
