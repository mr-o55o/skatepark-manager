<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseClassStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseClassStatusesTable Test Case
 */
class CourseClassStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseClassStatusesTable
     */
    public $CourseClassStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_class_statuses',
        'app.course_classes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseClassStatuses') ? [] : ['className' => CourseClassStatusesTable::class];
        $this->CourseClassStatuses = TableRegistry::getTableLocator()->get('CourseClassStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseClassStatuses);

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
