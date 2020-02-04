<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AthletesNotesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AthletesNotesTable Test Case
 */
class AthletesNotesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AthletesNotesTable
     */
    public $AthletesNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.athletes_notes',
        'app.athletes',
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
        $config = TableRegistry::getTableLocator()->exists('AthletesNotes') ? [] : ['className' => AthletesNotesTable::class];
        $this->AthletesNotes = TableRegistry::getTableLocator()->get('AthletesNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AthletesNotes);

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
