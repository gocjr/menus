<?php

namespace App\Model\Schema;

use Cake\ORM\TableRegistry;

/**
 * 
 */
class ItemSchema
{

    public static function addTable()
    {
        $name = 'items';
        $db = TableRegistry::getTableLocator()->get($name)->getConnection();
        $tables = $db->getSchemaCollection()->listTables();
        if (!in_array($name, $tables)) {
            $schema = $db->getDriver()->newTableSchema($name);
            $schema
                ->addColumn('id', [
                    'type' => 'integer', 'length' => 11, 'null' => false, 'default' => null,
                ])
                ->addColumn('menu_id', [
                    'type' => 'char', 'length' => 36, 'default' => null,
                ])
                ->addColumn('user_id', [
                    'type' => 'integer', 'length' => 11, 'default' => null,
                ])
                ->addColumn('parent_id', [
                    'type' => 'integer', 'length' => 11, 'default' => null,
                ])
                ->addColumn('title', [
                    'type' => 'string', 'length' => 100,
                ])
                ->addColumn('slug', [
                    'type' => 'string', 'length' => 100,
                ])
                ->addColumn('model', [
                    'type' => 'string', 'length' => 50,
                ])
                ->addColumn('url', [
                    'type' => 'text',
                ])
                ->addColumn('attrs', [
                    'type' => 'text',
                ])
                ->addColumn('status', [
                    'type' => 'tinyinteger', 'length' => 1, 'default' => null, 'fixed' => true
                ])
                ->addColumn('created', [
                    'type' => 'datetime',
                ])
                ->addColumn('modified', [
                    'type' => 'datetime',
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
        $name = 'items';
        $tableLocator = TableRegistry::getTableLocator();
        $table = $tableLocator->get($name);
        $db = $table->getConnection();
      
        $schema = $table->getSchema();
        $sql = $schema->dropSql($db);
        $db->execute($sql);
    }
}
