<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseSessionStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseSessionStatusesTable Test Case
 */
class CourseSessionStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseSessionStatusesTable
     */
    public $CourseSessionStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_session_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseSessionStatuses') ? [] : ['className' => CourseSessionStatusesTable::class];
        $this->CourseSessionStatuses = TableRegistry::getTableLocator()->get('CourseSessionStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseSessionStatuses);

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
