<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\row[]|\Cake\Collection\CollectionInterface $rows
 */
$trRows[] = 'style="width:20%;';
$trRows[] = 'class="p-0"';
$trRows[] = 'class="text-center w-5"';
$trRows[] = 'class="d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell"';


$this->assign('title', $menu->title);
$this->extend('Appearances./Admin/Common/index');
?>
<!--table.thead.tr-->
<?php $this->start('thread'); ?>
<th <?php echo $trRows[0] ?>><?php echo $this->Paginator->sort('id') ?></th>
<th <?php echo $trRows[1] ?>><?php echo $this->Paginator->sort('title', __('Title')) ?></th>
<th <?php echo $trRows[2] ?>><?php echo $this->Paginator->sort('item_count', 'Total de Items') ?></th>
<th class="actions"><?php echo __('Actions') ?></th>
<?php $this->end(); ?>

<!--table.tbody.tr-->
<?php $this->start('tbody'); ?>
<td <?php echo $trRows[0] ?>>{{ $this->Number->format($row->id) }}</td>
<td <?php echo $trRows[1] ?>>{{ $this->Html->link($row->title, ['controller' => 'Items', 'action' => 'index', 'target' => $row->id], ['afterText' => $row->slug])  }}</td>
<td <?php echo $trRows[2] ?>>{{ h($row->item_count) }}</td>
<td class="actions">
    {{ $this->element('bootstrap4/link/view',$url->view) }} -
    {{ $this->element('bootstrap4/link/edit',$url->edit) }}
</td>
<?php $this->end(); ?>