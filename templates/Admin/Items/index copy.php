<?php

$this->assign('title', 'Admin/' . $menu->title);
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $items
 */
$colVisible = 'class="d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell" ';
$routeFk = 'target';

$crumbs[0] = ['title' => 'Admin', 'url' =>  '/admin/dashboard'];
$crumbs[1] = ['title' => 'Menus', 'url' => '/admin/menus'];
$crumbs[2] = ['title' => $menu->title, 'url' => null];
$this->viewVars['crumbs'] =  $crumbs;
$target = $menu->id;

$this->extend('/Admin/Common/index');
?>
<!--actions buttons-->
<?php $this->start('actions'); ?>
<div class="btn-group btn-group-sm">
    <?= $this->element('Bootstrap4/btn/back', ['url' => $crumbs[1]['url']]) ?>
    <?= $this->element('Bootstrap4/btn/add', ['url' => ['action' => 'add', $routeFk => $target]]) ?>
    <?= $this->element('Bootstrap4/btn/deleteAll') ?>
</div>
<?php $this->end(); ?>

<!--table thead-->
<?php $this->start('thead'); ?>
<th style="width:3%;"><?= $this->Paginator->sort('id') ?></th>
<th><?= $this->Paginator->sort('title', __('Title') . '(slug)') ?></th>
<th <?= $colVisible ?>><?= $this->Paginator->sort('parent_id') ?></th>
<th><?= $this->Paginator->sort('user_id') ?></th>
<th <?= $colVisible ?>><?= $this->Paginator->sort('created') ?></th>
<th <?= $colVisible ?>><?= $this->Paginator->sort('modified') ?></th>
<th><?= __('Actions') ?></th>
<?php $this->end(); ?>

<!--table tbody-->
<?php $this->start('tbody'); ?>
<td style="width:3%;">{{id}}</td>
<td class="py-0">
    {{title}} <span class="d-block m-0 small">{{slug}}</span>
</td>
<td <?= $colVisible ?>>{{parent_item}}</td>
<td>
    <a href="<?= $this->Url->build(['action' => 'edit', 'controller' => 'Users', 'plugin' => 'Users']) ?>/{{user_id}}">{{user}}</a>
</td>
<td <?= $colVisible ?>>{{created}}</td>
<td <?= $colVisible ?>>{{modified}}</td>
<td>
    <?= $this->element('Bootstrap4/link/view', ['url' => $this->Url->build(['action' => 'view', $routeFk => $target]) . '/{{id}}']) ?>
    | <?= $this->element('Bootstrap4/link/edit', ['url' => $this->Url->build(['action' => 'edit', $routeFk => $target]) . '/{{id}}']) ?>
</td>
<?php $this->end(); ?>