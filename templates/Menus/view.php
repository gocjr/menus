<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menu
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="menus view content">
            <h3><?= h($menu->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($menu->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($menu->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menu->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Item Count') ?></th>
                    <td><?= $this->Number->format($menu->item_count) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Items') ?></h4>
                <?php if (!empty($menu->items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Menu Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menu->items as $items) : ?>
                        <tr>
                            <td><?= h($items->id) ?></td>
                            <td><?= h($items->user_id) ?></td>
                            <td><?= h($items->menu_id) ?></td>
                            <td><?= h($items->parent_id) ?></td>
                            <td><?= h($items->title) ?></td>
                            <td><?= h($items->slug) ?></td>
                            <td><?= h($items->link) ?></td>
                            <td><?= h($items->status) ?></td>
                            <td><?= h($items->created) ?></td>
                            <td><?= h($items->modified) ?></td>
                            <td><?= h($items->lft) ?></td>
                            <td><?= h($items->rght) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Items', 'action' => 'view', $items->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Items', 'action' => 'edit', $items->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Items', 'action' => 'delete', $items->id], ['confirm' => __('Are you sure you want to delete # {0}?', $items->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
