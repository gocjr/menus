<?php

declare(strict_types=1);

namespace Menus\View\Cell;

use Cake\Utility\Text;
use Cake\View\Cell;

/**
 * Menus cell
 */
class MenusCell extends Cell
{
    /**
     * Default display method.
     *
     * @return void
     */
    public function display($target = 'admin')
    {
        $request = $this->request;
        $name = ($request->getParam('plugin') ?? $request->getParam('controller'));

        if (!isset($this->Items)) {
            $this->loadModel('Menus.Items');
        }

        $items = $this->Items
            ->find('all')
            ->select([
                'Items.id', 'Items.parent_id', 'Items.title', 'Items.slug', 'Items.link', 'Items.model',
                'ParentItems.id', 'ParentItems.parent_id', 'ParentItems.title', 'ParentItems.slug', 'ParentItems.link', 'ParentItems.model'
            ])
            ->contain([
                'Menus' => ['fields' => ['title'], 'conditions' => ['Menus.slug' => $target]],
                'ParentItems' => ['conditions' => ['Menus.id=ParentItems.menu_id', 'OR' => ['ParentItems.title' => $name, 'ParentItems.slug' => $name]]]
            ])
            ->where([
                'Items.menu_id = Menus.id AND Items.parent_id IS NULL OR Items.parent_id = ParentItems.id', 'Items.status' => 1,
            ])
            ->order(['Items.lft' => 'asc'])
            ->toArray();

        $items = $this->build($items);
        $items = $this->tree($items);
        $this->set('items', $items);
    }

    protected function build($items)
    {
        $rows = [];
        foreach ($items as $i => $item) {
            if ($item->model) {
                list($plugin, $name) = pluginSplit($item->model);
                $model = (isset($this->{$name}) ? $this->{$name} : $this->loadModel($item->model));
                $newItems = $model->find('list')->toArray();
                foreach ($newItems as $id => $title) :
                    $rows[] = $this->Items->newEntity([
                        'id' => $id,
                        'parent_id' => $item->parent_id,
                        'title' => $title,
                        'slug' => strtolower(Text::slug($title, '-')),
                        'link' => preg_replace('/\/:([\w]+)/', '$0:' . $id, $item->link)
                    ]);
                endforeach;
                unset($items[$i]);
            } else {
                $rows[] = $item;
            }
        }
        return  $rows;
    }

    protected function tree($itemList, $parentId = null)
    {
        $result = [];
        foreach ($itemList as $item) :
            if ($item['parent_id'] == $parentId) :
                if ($item['id']) {
                    $item['children'] = $this->tree($itemList, $item['id']);
                }
                $result[] = $item;
            endif;
        endforeach;
        return $result;
    }
}
