<?php

/**
 * @method App\View\Helper\Bootstrap4\HtmlHelper $html
 */
?>

<?php foreach ($items as $i => $item) : ?>
    <?php
    $item->link = $this->Url->build($item->link);
    $item->attrs = ['class' => 'nav-link', 'actived' => (bool) $this->Url->isHere($item->link)];
    ?>
    <?php if (empty($item['children'])) : ?>
        <li class="nav-item <?= $item->attrs['actived'] ?>">
            <?= $this->Html->link($item->title, $item->link, $item->attrs); ?>
        </li>
    <?php else : ?>
        <li class="nav-item <?= $item->attrs['actived'] ?>">
            <?= $this->Html->link($item->title, $item->link, $item->attrs); ?>
            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php
                    foreach ($item['children'] as $i => $children) :
                        $children->link = $this->Url->build($children->link);
                        $children->attrs = ['class' => 'collapse-item', 'escapeTitle' => false, 'actived' => $this->Url->isHere($children->link)];
                        echo $this->Html->link($children->title, $children->link, $children->attrs);
                    endforeach;
                    ?>
                </div>
            </div>
        </li>
    <?php endif; ?>
<?php endforeach; ?>