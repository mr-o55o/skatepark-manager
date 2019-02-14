<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ResponsiblePersonsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ResponsiblePersonsTable Test Case
 */
class ResponsiblePersonsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ResponsiblePersonsTable
     */
    public $ResponsiblePersons;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.responsible_persons',
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
        $config = TableRegistry::getTableLocator()->exists('ResponsiblePersons') ? [] : ['className' => ResponsiblePersonsTable::class];
        $this->ResponsiblePersons = TableRegistry::getTableLocator()->get('ResponsiblePersons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResponsiblePersons);

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
