<?php
$routeFk = 'target';

$crumbs['admin'] = ['title' => 'Admin', 'url' =>  '/admin/dashboard'];
$crumbs['fipe'] = ['title' => 'Fipe', 'url' => '/admin/fipe'];
$crumbs['tipos'] = ['title' => 'Tipos', 'url' => '/admin/fipe/tipos'];
$crumbs['marcas'] = ['title' => 'Marcas', 'url' => null];
$this->viewVars['crumbs'] =  $crumbs;

$this->extend('/Admin/Common/index'); ?>

<?php $this->start('actions'); ?>
<div class="btn-group btn-group-sm">
    <?= $this->element('Bootstrap4/btn/add', ['url' => ['action' => 'add']]) ?>
    <?= $this->element('Bootstrap4/btn/deleteAll') ?>
</div>
<?php $this->end(); ?>

<?php $this->start('thead'); ?>
<th style="width:10%;"><?= $this->Paginator->sort('id') ?></th>
<th><?= $this->Paginator->sort('title', __('Title') ) ?></th>
<th><?= $this->Paginator->sort('item_count', 'Total') ?></th>
<th><?= __('Actions') ?></th>
<?php $this->end(); ?>

<?php $this->start('tbody'); ?>
<td style="width:10%;">{{id}}</td>
<td class="p-0 m-0">
    <a href="<?= $this->Url->build(['controller' => 'Items', 'action' => 'index', $routeFk => '{{id}}']) ?>">
        {{title}} <p class="small p-0 m-0">{{slug}}</p>
    </a>
</td>
<td>{{item_count}}</td>
<td><?= $this->element('Bootstrap4/link/edit', ['url' => $this->Url->build(['action' => 'edit', $routeFk => '{{tipo_id}}']) . '/{{id}}']) ?></td>
<?php $this->end(); ?>