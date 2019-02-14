<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonEditionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonEditionsTable Test Case
 */
class LessonEditionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LessonEditionsTable
     */
    public $LessonEditions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lesson_editions',
        'app.lessons',
        'app.lesson_statuses',
        'app.athletes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LessonEditions') ? [] : ['className' => LessonEditionsTable::class];
        $this->LessonEditions = TableRegistry::getTableLocator()->get('LessonEditions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LessonEditions);

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
