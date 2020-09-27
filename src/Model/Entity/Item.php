<?php

declare(strict_types=1);

namespace Menus\Model\Entity;

use Cake\ORM\Entity;
use Cake\Utility\Text;

/**
 * Item Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $menu_id
 * @property int|null $parent_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $link
 * @property string|null $status
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $lft
 * @property int|null $rght
 *
 * @property \Menus\Model\Entity\Menu $menu
 * @property \Menus\Model\Entity\User $user
 */
class Item extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'menu_id' => true,
        'parent_id' => true,
        'title' => true,
        'slug' => true,
        'link' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'lft' => true,
        'rght' => true,
        'menu' => true,
        'user' => true,
        'model' => true
    ];

    protected function _setTitle($title)
    {
        if (!$this->has('slug')) {
            $this->set('slug', strtolower(Text::slug($title, '-')));
        }
        return $title;
    }

}
