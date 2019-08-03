<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityStatusesTable Test Case
 */
class ActivityStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityStatusesTable
     */
    public $ActivityStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_statuses',
        'app.activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityStatuses') ? [] : ['className' => ActivityStatusesTable::class];
        $this->ActivityStatuses = TableRegistry::getTableLocator()->get('ActivityStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityStatuses);

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
