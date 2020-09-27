<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $menu
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Menus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="menus form content">
            <?= $this->Form->create($menu) ?>
            <fieldset>
                <legend><?= __('Add Menu') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('item_count');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
