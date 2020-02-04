<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityUsersTable Test Case
 */
class ActivityUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityUsersTable
     */
    public $ActivityUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activity_users',
        'app.activities',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityUsers') ? [] : ['className' => ActivityUsersTable::class];
        $this->ActivityUsers = TableRegistry::getTableLocator()->get('ActivityUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityUsers);

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
