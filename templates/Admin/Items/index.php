<?php
$this->assign('title', 'Admin/' . $menu->title);
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $items
 */
$trRows[] = 'style="width:20%;';
$trRows[] = 'class="p-0"';
$trRows[] = 'class="text-center w-5"';
$trRows[] = 'class="d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell"';
$trRows[] = '';
$this->extend('Appearances./Admin/Common/index');
?>

<?php $this->start('thread'); ?>
<th <?php echo $trRows[0] ?>><?php echo $this->Paginator->sort('id') ?></th>
<th <?php echo $trRows[1] ?>><?php echo $this->Paginator->sort('title') ?></th>
<th <?php echo $trRows[3] ?>><?php echo $this->Paginator->sort('parent_id') ?></th>
<th <?php echo $trRows[2] ?>><?php echo $this->Paginator->sort('user_id') ?></th>
<th <?php echo $trRows[2] ?>><?php echo $this->Paginator->sort('created') ?></th>
<th <?php echo $trRows[2] ?>><?php echo $this->Paginator->sort('modified') ?></th>
<th class="actions"><?php echo __('Actions') ?></th>
<?php $this->end('thread'); ?>

<?php $this->start('tbody'); ?>
<td <?php echo $trRows[0] ?>>{{ $row->id }}</td>
<td <?php echo $trRows[1] ?>>{{ $row->title.$this->Html->small($row->title,['class'=>'d-block']) }}</td>
<td <?php echo $trRows[3] ?>>{{ h($row->parent_item) ?></td>
<td <?php echo $trRows[2] ?>>{{ h($row->user) ?></td>
<td <?php echo $trRows[2] ?>>{{ $row->created}}</td>
<td <?php echo $trRows[2] ?>>{{ $row->modified}}</td>
<td class="actions">
    {{ $this->element('bootstrap4/link/view') ?> -
    {{ $this->element('bootstrap4/link/edit') ?>
</td>
<?php $this->end('tbody'); ?>