<?php

$this->assign('title', 'Admin/' . $menu->title);
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $items
 */
$colVisible = 'class="d-none d-sm-none d-md-none d-lg-table-cell d-xl-table-cell" ';
$routeFk = 'target';
$target = $menu->id;
?>
<!--actions buttons-->

<?= $this->Form->create($formData) ?>
<div class="card shadow m-0">
    <div class="card-header btn-group-sm px-3">
        <?= $this->element('Bootstrap4/btn/add', ['url' => ['action' => 'add',$routeFk =>$target]]) ?>
        <?= $this->element('Bootstrap4/btn/deleteAll') ?>
        <div class="d-inline-block col-5">
            <?= $this->element('Bootstrap4/form/search') ?>
        </div>
    </div>
    <table class="table table-striped table-borderless m-0">
        <thead>
            <tr>
                <th><?= $this->Form->checkbox('checkall') ?></th>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('title', __('Title')) ?></th>
                <th <?= $colVisible ?>><?= $this->Paginator->sort('parent_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th <?= $colVisible ?>><?= $this->Paginator->sort('created') ?></th>
                <th <?= $colVisible ?>><?= $this->Paginator->sort('modified') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $i => $row) : ?>
                <tr>
                    <td><?= $this->Form->checkbox('check.' . $i, ['value' => $row->id, 'class' => 'child']) ?></td>
                    <td><?= $this->Number->format($row->id) ?></td>
                    <td class="p-0 "><?= h($row->title) ?> <span class="d-block m-0 small"><?= h($row->slug) ?></span></td>
                    <td><?= h($row->parent_item) ?></td>
                    <td><?= h($row->user) ?></td>
                    <td><?= h($row->created) ?></td>
                    <td><?= h($row->modified) ?></td>
                    <td class="actions">
                        <?= $this->element('Bootstrap4/link/view', ['url' => ['action' => 'view', $row->id,$routeFk =>$target]]) ?> -
                        <?= $this->element('Bootstrap4/link/edit', ['url' => ['action' => 'edit', $row->id,$routeFk =>$target]]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class=" card-footer">
        <?= $this->element('Bootstrap4/btn/paginator') ?>
    </div>
</div>
<?= $this->Form->end() ?>