<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CourseSubscriptionTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CourseSubscriptionTypesTable Test Case
 */
class CourseSubscriptionTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CourseSubscriptionTypesTable
     */
    public $CourseSubscriptionTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.course_subscription_types',
        'app.course_subscriptions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CourseSubscriptionTypes') ? [] : ['className' => CourseSubscriptionTypesTable::class];
        $this->CourseSubscriptionTypes = TableRegistry::getTableLocator()->get('CourseSubscriptionTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CourseSubscriptionTypes);

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
