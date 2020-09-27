<?php
declare(strict_types=1);

namespace Menus\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Menus\Model\Table\MenusTable;

/**
 * Menus\Model\Table\MenusTable Test Case
 */
class MenusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Menus\Model\Table\MenusTable
     */
    protected $Menus;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Menus.Menus',
        'plugin.Menus.Items',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Menus') ? [] : ['className' => MenusTable::class];
        $this->Menus = TableRegistry::getTableLocator()->get('Menus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Menus);

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
}
