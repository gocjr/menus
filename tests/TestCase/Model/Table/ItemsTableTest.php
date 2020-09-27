<?php
declare(strict_types=1);

namespace Menus\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Menus\Model\Table\ItemsTable;

/**
 * Menus\Model\Table\ItemsTable Test Case
 */
class ItemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Menus\Model\Table\ItemsTable
     */
    protected $Items;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Menus.Items',
        'plugin.Menus.Menus',
        'plugin.Menus.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Items') ? [] : ['className' => ItemsTable::class];
        $this->Items = TableRegistry::getTableLocator()->get('Items', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Items);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
