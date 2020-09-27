<?php

namespace App\Model\Table\Schemas;

use Cake\Database\Query;
use Cake\ORM\TableRegistry;

/**
 * 
 */
class MenuSchema
{

    public static function addTable()
    {
        $name = 'menus';
        $db = TableRegistry::getTableLocator()->get($name)->getConnection();
        $tables = $db->getSchemaCollection()->listTables();
        if (!in_array($name, $tables)) {
            $schema = $db->getDriver()->newTableSchema($name);
            $schema
                ->addColumn('id', [
                    'type' => 'integer', 'length' => 11, 'null' => false, 'default' => null,
                ])
                ->addColumn('title', [
                    'type' => 'string', 'length' => 100,
                ])
                ->addColumn('slug', [
                    'type' => 'string', 'length' => 100,
                ])
                ->addColumn('item_count', [
                    'type' => 'integer', 'length' => 10,
                ])
                ->addConstraint('primary', [
                    'type' => 'primary',
                    'columns' => ['id']
                ])
                ->setOptions([
                    'engine' => 'InnoDB',
                    'collate' => 'utf8_unicode_ci',
                ]);

            $queries = $schema->createSql($db);
            foreach ($queries as $sql) {
                $db->execute($sql);
            }
        }
    }
    public static function removeTable()
    {
        $name = 'menus';
        $db = TableRegistry::getTableLocator()->get($name)->getConnection();
        $schema = $db->getDriver()->getSchema();
        $sql = $schema->dropSql($db);
        $db->execute($sql);
    }
}
