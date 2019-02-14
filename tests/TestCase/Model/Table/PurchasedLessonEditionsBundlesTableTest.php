<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PurchasedLessonEditionsBundlesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PurchasedLessonEditionsBundlesTable Test Case
 */
class PurchasedLessonEditionsBundlesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PurchasedLessonEditionsBundlesTable
     */
    public $PurchasedLessonEditionsBundles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.purchased_lesson_editions_bundles',
        'app.athletes',
        'app.lesson_editions_bundles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PurchasedLessonEditionsBundles') ? [] : ['className' => PurchasedLessonEditionsBundlesTable::class];
        $this->PurchasedLessonEditionsBundles = TableRegistry::getTableLocator()->get('PurchasedLessonEditionsBundles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PurchasedLessonEditionsBundles);

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
