<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\row[]|\Cake\Collection\CollectionInterface $rows
 */
$trRows[] = 'text-center w-5';
$trRows[] = 'd-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell';
$trRows[] = 'p-0';

$this->assign('title', $menu->title);
$this->extend('Appearances.Admin/Common/index');
?>
<!--table.thead.tr-->
<?php $this->start('thread'); ?>
<th class="<?= $trRows[1] ?>"><?= $this->Paginator->sort('id') ?></th>
<th><?= $this->Paginator->sort('title', __('Title')) ?></th>
<th class="<?= $trRows[1] ?>"><?= $this->Paginator->sort('item_count','Total de Items') ?></th>
<th class="actions"><?= __('Actions') ?></th>
<?php $this->end(); ?>

<!--table.tbody.tr-->
<?php $this->start('tbody'); ?>
<td class="<?= $trRows[1] ?>">{{ $this->Number->format($row->id) }}</td>
<td class="<?= $trRows[2] ?>">{{ $this->Html->link($row->title, ['controller' => 'Items', 'action' => 'index', 'target' => $row->id], ['afterText' => $row->slug])  }}</td>
<td class="<?= $trRows[1] ?>">{{ h($row->item_count) }}</td>
<td class="actions">
    {{ $this->element('bootstrap4/link/view',$url->view) }} -
    {{ $this->element('bootstrap4/link/edit',$url->edit) }}
</td>
<?php $this->end(); ?>