<?php
declare(strict_types=1);

namespace Menus\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menus Model
 *
 * @property \Menus\Model\Table\ItemsTable&\Cake\ORM\Association\HasMany $Items
 *
 * @method \Menus\Model\Entity\Menu get($primaryKey, $options = [])
 * @method \Menus\Model\Entity\Menu newEntity($data = null, array $options = [])
 * @method \Menus\Model\Entity\Menu[] newEntities(array $data, array $options = [])
 * @method \Menus\Model\Entity\Menu|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Menus\Model\Entity\Menu saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Menus\Model\Entity\Menu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Menus\Model\Entity\Menu[] patchEntities($entities, array $data, array $options = [])
 * @method \Menus\Model\Entity\Menu findOrCreate($search, callable $callback = null, $options = [])
 */
class MenusTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('menus');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->hasMany('Items', [
            'foreignKey' => 'menu_id',
            'className' => 'Menus.Items',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 150)
            ->allowEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 150)
            ->allowEmptyString('slug');

        $validator
            ->integer('item_count')
            ->allowEmptyString('item_count');

        return $validator;
    }
}
