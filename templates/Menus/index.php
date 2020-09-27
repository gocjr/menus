<?php

$trRows[] = 'text-center w-5';
$trRows[] = 'd-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell';
$trRows[] = 'p-0';

$this->assign('title', $menu->title);
$this->extend('Appearances.Admin/Common/index');

$this->start('before.actions');
echo $this->Html->link('Menus', ['action' => 'index', 'controller' => 'menus'], ['class' => 'btn btn-warning', 'icon' => 'caret-square-left']);
$this->end();
?>


<!--table.thead.tr-->
<?php $this->start('thread'); ?>
<th class="<?= $trRows[1] ?>"><?= $this->Paginator->sort('id') ?></th>
<th><?= $this->Paginator->sort('title', __('Title')) ?></th>
<th><?= $this->Paginator->sort('item_count') ?></th>
<th class="actions"><?= __('Actions') ?></th>
<?php $this->end(); ?>

<!--table.tbody.tr-->
<?php $this->start('tbody'); ?>
<td class="<?= $trRows[1] ?>">{{ $this->Number->format($row->id) }}</td>
<td>{{ $row->title . $this->Html->small($row->slug, ['class' => 'd-block']) }}</td>
<td>{{ h($row->item_count) }}</td>
<td class="actions">
    {{ $this->element('bootstrap4/link/view') }} -
    {{ $this->element('bootstrap4/link/edit') }}
</td>
<?php $this->end(); ?>