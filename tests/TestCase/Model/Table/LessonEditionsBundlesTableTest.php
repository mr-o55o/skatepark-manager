<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LessonEditionsBundlesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LessonEditionsBundlesTable Test Case
 */
class LessonEditionsBundlesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LessonEditionsBundlesTable
     */
    public $LessonEditionsBundles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lesson_editions_bundles',
        'app.purchased_lesson_editions_bundles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('LessonEditionsBundles') ? [] : ['className' => LessonEditionsBundlesTable::class];
        $this->LessonEditionsBundles = TableRegistry::getTableLocator()->get('LessonEditionsBundles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LessonEditionsBundles);

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
