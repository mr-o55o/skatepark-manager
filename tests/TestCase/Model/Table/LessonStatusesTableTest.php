<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonStatusesTable Test Case
 */
class LessonStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LessonStatusesTable
     */
    public $LessonStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lesson_statuses',
        'app.lesson_editions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LessonStatuses') ? [] : ['className' => LessonStatusesTable::class];
        $this->LessonStatuses = TableRegistry::getTableLocator()->get('LessonStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LessonStatuses);

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
