<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseEditionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseEditionsTable Test Case
 */
class CourseEditionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseEditionsTable
     */
    public $CourseEditions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_editions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseEditions') ? [] : ['className' => CourseEditionsTable::class];
        $this->CourseEditions = TableRegistry::getTableLocator()->get('CourseEditions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseEditions);

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
