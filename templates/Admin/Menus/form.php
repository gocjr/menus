<?php

$crumbs['admin'] = ['title' => 'Admin', 'url' =>  '/admin/dashboard'];
$crumbs['menus'] = ['title' => 'Menus', 'url' => '/admin/menus'];
$crumbs['action'] = ['title' => $this->request->getParam('action'), 'url' => null];
$this->viewVars['crumbs'] =  $crumbs;
?>

<?= $this->Form->create($row); ?>
<div class="actions btn-group btn-group-sm">
    <?= $this->element('Bootstrap4/btn/cancel', ['url' => $crumbs['menus']['url']]); ?>
    <?= $this->element('Bootstrap4/btn/apply'); ?>
    <?= $this->element('Bootstrap4/btn/save'); ?>
</div>
<div class="row mt-4">
    <div class="col-12">
        <?php
        echo $this->Form->control('title', ['type' => 'text']);
        echo $this->Form->control('slug', ['type' => 'text']);
        ?>
    </div>
</div>
<?= $this->Form->end(); ?>