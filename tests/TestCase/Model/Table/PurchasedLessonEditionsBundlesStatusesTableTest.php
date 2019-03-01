<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchasedLessonEditionsBundlesStatusesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchasedLessonEditionsBundlesStatusesTable Test Case
 */
class PurchasedLessonEditionsBundlesStatusesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchasedLessonEditionsBundlesStatusesTable
     */
    public $PurchasedLessonEditionsBundlesStatuses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchased_lesson_editions_bundles_statuses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PurchasedLessonEditionsBundlesStatuses') ? [] : ['className' => PurchasedLessonEditionsBundlesStatusesTable::class];
        $this->PurchasedLessonEditionsBundlesStatuses = TableRegistry::getTableLocator()->get('PurchasedLessonEditionsBundlesStatuses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchasedLessonEditionsBundlesStatuses);

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
