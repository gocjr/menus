<table class="table table-bordered table-striped table-xl-responsive mt-2">
    <tr>
        <th><?= __('Id') ?></th>
        <td><?= $this->Number->format($item->id) ?></td>
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
        <th><?= __('Total') ?></th>
        <td><?= h($item->item_count) ?></td>
    </tr>
</table>