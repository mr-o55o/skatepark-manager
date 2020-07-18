<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AthleteRanksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AthleteRanksTable Test Case
 */
class AthleteRanksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AthleteRanksTable
     */
    public $AthleteRanks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.athlete_ranks',
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
        $config = TableRegistry::getTableLocator()->exists('AthleteRanks') ? [] : ['className' => AthleteRanksTable::class];
        $this->AthleteRanks = TableRegistry::getTableLocator()->get('AthleteRanks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AthleteRanks);

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
