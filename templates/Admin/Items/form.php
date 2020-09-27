<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $item
 */
$rels = [
    'alternate', 'author', 'bookmark', 'external', 'help', 'license', 'next', 'nofollow', 'noreferrer', 'noopener', 'prev', 'search', 'tag'
];

$status = [
    'Unpublished', 'Published'
];

$targets = [
    '_blank' => '_blank', '_parent' => '_parent', '_self' => '_self', '_top' => '_top'
];

$divisors = [
    'before' => 'Antes', 'after' => 'Depois'
];

$colLeft = [];
$colLeft['menu_id'] = ['value' => (string) $menu->id, 'type' => 'hidden'];
$colLeft['user_id'] = ['value' => (string) empty($userData->id) ? '' : $userData->id, 'type' => 'hidden'];
$colLeft['title'] = ['type' => 'text'];
$colLeft['slug'] = ['type' => 'text'];
$colLeft['url'] = ['id' => 'inputUrl', 'type' => 'search', 'label' => 'Link', 'button' => ['title' => __('search'), 'icon' => 'search', 'data-target' => '#linksModal', 'data-toggle' => 'modal']];
$colLeft['attrs.rel'] = ['options' => $rels, 'empty' => true];
$colLeft['attrs.icon'] = ['options' => $icons, 'empty' => true, 'type' => 'dropdown-select'];
$colLeft['attrs.target'] = ['options' => $targets, 'empty' => true];
$colLeft['attrs.divisor'] = ['options' => $divisors, 'empty' => true];

$colRight = [];
$colRight['model'] = ['options' => $models, 'empty' => true];
$colRight['status'] = ['options' => $status];
$colRight['parent_id'] = ['options' => $parents, 'empty' => true, 'size' => 17];

$this->Html->script('/vendor/gocjr/jquery.slugable', ['block' => 'script']);
$this->Html->script('/vendor/gocjr/items-input-links', ['block' => 'script']);
$this->Html->script('/vendor/gocjr/items-input-icons', ['block' => 'script']);

$this->set(compact('colLeft', 'colRight'));
$this->extend('Appearances.Admin/Common/form');
?>


<?php $this->start('custom'); ?>
<div class="modal fade" id="linksModal" tabindex="-1" role="dialog" aria-labelledby="linksModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h5 class="modal-title" id="linksModalTitle">Links</h5>
                <button type="button" class="close m-2 p-1" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2" id="contents">
            </div>
            <div class="modal-footer btn-group-sm p-2">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-primary" id="apply" disabled><i class="fa fa-check"></i> Apply</button>
            </div>
        </div>
    </div>
</div>
<?php $this->end('custom'); ?>