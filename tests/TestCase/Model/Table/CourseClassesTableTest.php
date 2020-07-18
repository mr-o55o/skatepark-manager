<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseClassesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseClassesTable Test Case
 */
class CourseClassesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseClassesTable
     */
    public $CourseClasses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_classes',
        'app.course_periods',
        'app.course_editions',
        'app.course_class_statuses',
        'app.course_class_members'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseClasses') ? [] : ['className' => CourseClassesTable::class];
        $this->CourseClasses = TableRegistry::getTableLocator()->get('CourseClasses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseClasses);

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
