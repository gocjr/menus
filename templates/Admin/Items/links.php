<?php

/**
 * rows Templates
 * @property App\View\Helper\Bootstrap4\FormHelper $form;
 * @property App\View\Helper\Bootstrap4\HtmlHelper $html;
 */


$link = $this->request->getQuery('link');
?>
<ul>
    <?php foreach ($rows as $i => $row) : ?>
        <li><?= $this->Html->link($row->title, $row->link) ?></li>
        <?php if (!empty($row['children'])) : ?>
            <ul>
                <?php foreach ($row['children'] as $j => $child) : ?>
                    <li><?= $this->Html->link($child->title, $child->link) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>