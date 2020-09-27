<?php

declare(strict_types=1);

namespace Menus\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @property \Menus\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Menus\Model\Table\MenusTable&\Cake\ORM\Association\BelongsTo $Menus
 *
 * @method \Menus\Model\Entity\Item get($primaryKey, $options = [])
 * @method \Menus\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \Menus\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \Menus\Model\Entity\Item|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Menus\Model\Entity\Item saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Menus\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Menus\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \Menus\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 * @mixin \Cake\ORM\Behavior\CounterCacheBehavior
 */
class ItemsTable extends Table
{

    use ItemsTrait;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
    
        parent::initialize($config);

        $this->setTable('items');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');
        $this->addBehavior('CounterCache', [
            'Menus' => ['item_count'],
        ]);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users.Users',
        ]);
        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id',
            'className' => 'Menus.Menus',
        ]);
        $this->belongsTo('ParentItems', [
            'className' => 'Menus.Items',
            'foreignKey' => 'parent_id',
        ]);
        $this->hasMany('ChildItems', [
            'className' => 'Menus.Items',
            'foreignKey' => 'parent_id',
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
            ->scalar('link')
            ->allowEmptyString('link');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentItems'));

        return $rules;
    }


}
