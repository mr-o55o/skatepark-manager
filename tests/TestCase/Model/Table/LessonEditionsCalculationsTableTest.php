<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonEditionsCalculationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonEditionsCalculationsTable Test Case
 */
class LessonEditionsCalculationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LessonEditionsCalculationsTable
     */
    public $LessonEditionsCalculations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lesson_editions_calculations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LessonEditionsCalculations') ? [] : ['className' => LessonEditionsCalculationsTable::class];
        $this->LessonEditionsCalculations = TableRegistry::getTableLocator()->get('LessonEditionsCalculations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LessonEditionsCalculations);

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
