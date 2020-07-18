<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseClassMembersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseClassMembersTable Test Case
 */
class CourseClassMembersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseClassMembersTable
     */
    public $CourseClassMembers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_class_members',
        'app.course_subscriptions',
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
        $config = TableRegistry::getTableLocator()->exists('CourseClassMembers') ? [] : ['className' => CourseClassMembersTable::class];
        $this->CourseClassMembers = TableRegistry::getTableLocator()->get('CourseClassMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseClassMembers);

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
