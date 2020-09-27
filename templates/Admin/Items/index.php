<?php
$this->assign('title', 'Admin/' . $menu->title);
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $items
 */
$colVisible = 'class="d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell" ';
$routeFk = 'target';
$target = $menu->id;
$this->extend('Appearances.Admin/Common/index');
?>

<?php $this->start('thread'); ?>
<th><?= $this->Paginator->sort('id') ?></th>
<th><?= $this->Paginator->sort('title', __('Title')) ?></th>
<th <?= $colVisible ?>><?= $this->Paginator->sort('parent_id') ?></th>
<th><?= $this->Paginator->sort('user_id') ?></th>
<th <?= $colVisible ?>><?= $this->Paginator->sort('created') ?></th>
<th <?= $colVisible ?>><?= $this->Paginator->sort('modified') ?></th>
<th><?= __('Actions') ?></th>
<?php $this->end('thread'); ?>

<?php $this->start('tbody'); ?>
<td>{{ $row->id }}</td>
<td>{{ $row->title.$this->Html->small($row->title,['class'=>'d-block']) }}</td>
<td>{{ h($row->parent_item) ?></td>
<td>{{ h($row->user) ?></td>
<td>{{ $row->created}}</td>
<td>{{ $row->modified}}</td>
<td class="actions">
    {{ $this->element('bootstrap4/link/view') ?> -
    {{ $this->element('bootstrap4/link/edit') ?>
</td>
<?php $this->end('tbody'); ?>