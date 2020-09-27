<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $item
 */

$urls = [
    ['action' => 'index', 'target' => $menu->id],
    ['action' => 'add', 'target' => $menu->id],
    ['action' => 'edit', 'target' => $menu->id, $item->id],
    ['action' => 'delete', 'target' => $menu->id, $item->id],
];

$crumbs[0] = ['title' => 'Admin', 'url' =>  '/admin/dashboard'];
$crumbs[1] = ['title' => 'Menus', 'url' => '/admin/menus'];
$crumbs[2] = ['title' => $menu->title, 'url' => $urls[0]];
$crumbs[3] = ['title' => $item->title, 'url' => null];
$this->viewVars['crumbs'] =  $crumbs;

?>

<div class="btn-group btn-group-sm">
    <?= $this->element('Bootstrap4/btn/back', ['url' => $urls[0]]) ?>
    <?= $this->element('Bootstrap4/btn/add', ['url' => $urls[1]]) ?>
    <?= $this->element('Bootstrap4/btn/edit', ['url' => $urls[2]]) ?>
    <?= $this->element('Bootstrap4/btn/delete', ['url' => $urls[3]]) ?>
</div>

<table class="table table-bordered table-striped table-xl-responsive mt-2">
    <tr>
        <th><?= __('Id') ?></th>
        <td><?= $this->Number->format($item->id) ?></td>
    </tr>
    <tr>
        <th><?= __('Menu') ?></th>
        <td><?= $item->has('menu') ? $this->Html->link($item->menu->title, ['controller' => 'Menus', 'action' => 'view', $item->menu->id]) : '' ?></td>
    </tr>
    <tr>
        <th><?= __('User') ?></th>
        <td><?= $item->has('user') ? $this->Html->link($item->user->username, ['controller' => 'Users', 'action' => 'view', $item->user->id]) : '' ?></td>
    </tr>
    <tr>
        <th><?= __('Title') ?></th>
        <td><?= h($item->title) ?></td>
    </tr>
    <tr>
        <th><?= __('Slug') ?></th>
        <td><?= h($item->slug) ?></td>
    </tr>

    <tr>
        <th><?= __('Created') ?></th>
        <td><?= h($item->created) ?></td>
    </tr>
    <tr>
        <th><?= __('Modified') ?></th>
        <td><?= h($item->modified) ?></td>
    </tr>
    <tr>
        <th><?= __('Link') ?></th>
        <td><?= h($item->link) ?></td>
    </tr>
    <tr>
        <th><?= __('Model') ?></th>
        <td><?= $item->model ?: 'undefined'; ?></td>
    </tr>
</table>