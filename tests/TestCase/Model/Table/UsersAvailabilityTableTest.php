<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersAvailabilityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersAvailabilityTable Test Case
 */
class UsersAvailabilityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersAvailabilityTable
     */
    public $UsersAvailability;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_availability',
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
        $config = TableRegistry::getTableLocator()->exists('UsersAvailability') ? [] : ['className' => UsersAvailabilityTable::class];
        $this->UsersAvailability = TableRegistry::getTableLocator()->get('UsersAvailability', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersAvailability);

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
