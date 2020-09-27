<?php

declare(strict_types=1);

namespace Menus\Model\Table\Traits;

use App\ApplicationMap;
use Cake\Core\Plugin;
use Cake\Database\Query;
use Cake\ORM\TableRegistry;
use Menus\Model\Entity\Item;
use phpDocumentor\Reflection\Types\This;

trait ItemsTrait
{
    public function findAllModels()
    {
        $map = new ApplicationMap('Model/Table');
        foreach (Plugin::loaded() as $plugin) {
            $map->setPath($plugin);
        }

        return $map->getRows();
    }


    public function formatToTree(array $rows = [], $i = 0)
    {
        $nodes = [];
        foreach ($rows as $row) {

            if ($row->spacer != $i || $row->spacer == null) {
                $row->spacer = $i;
                $this->query()->update()->set(['spacer' => $i])->where(['id' => $row->id])->execute();
            }
            $row->title = str_repeat('-', $row->spacer) . $row->title;
            $nodes[] = $row;
            if (!empty($row['children'])) {
                $nodes = array_merge($nodes, $this->formatToTree($row['children'], $i + 1));
            }
        }

        return $nodes;
    }

    public function findFiltred(Query $query, array $options): Query
    {
        $query
            ->find('threaded', $options)
            ->formatResults(function ($q) {
                $nodes = $this->formatToTree($q->toArray());
                return $q
                    ->filter(function ($item) {
                        return false;
                    })
                    ->append($nodes)
                    ->map(function ($row) {
                        $row->user = $row->user['username'];
                        $row->parent_item = $row->parent_item['title'];
                        return $row;
                    });
            });
        return  $query;
    }

    public function findTreeByMenuId(string $menu_id): Query
    {
        $options['conditions'] = ['Items.menu_id' => (int)$menu_id, 'Items.status' => 1];
        return $this->treeAll($options);
    }

    public function findTreeByMenuSlug(string $menu_slug): Query
    {
        $options['fields'] = ['Items.id', 'Items.parent_id', 'Items.title', 'Items.slug', 'Items.link', 'Items.model', 'Items.attrs'];
        $options['contain']['Menus'] = ['fields' => ['Menus.title'], 'conditions' => ['Menus.slug' => $menu_slug]];
        $options['conditions'] = ['Items.menu_id = Menus.id', 'Items.status' => 1];
        return $this->treeAll($options);
    }

    public function treeAll(array $options = [])
    {

        return $this
            ->find('all',  $options)
            ->formatResults(function ($collection) {
                $rows = [];
                $lastId = $this->find()->order(['id' => 'desc'])->select(['id'])->first()->id;
                $collection = $collection
                    ->each(function ($item) use (&$rows, &$lastId) {
                        $item->menu = $item->menu->title;
                        if ($item->model) :
                            $model = $this->_getModelInstance($item->model);
                            $newItems = $model->find()->toArray();
                            foreach ($newItems as $i => $newItem) :
                                $newItem->parent_id = $item->parent_id;
                                $newItem->link = $this->formatLink($item->link, $newItem);
                                $newItem->id = $lastId++;
                                $rows[] = $newItem;
                            endforeach;
                        else :
                            $rows[] = $item;
                        endif;
                        return $item;
                    })
                    ->filter(function () {
                        return [];
                    });
                $rows = $this->recursive($rows);
                return $collection->append($rows);
            });
    }

    protected function recursive($items, $parentId = null)
    {
        $output = [];
        foreach ($items as $item) :
            if ($item['parent_id'] == $parentId) :
                if ($item['id']) {
                    $item['children'] = $this->recursive($items, $item['id']);
                }
                $output[] = $item;
            endif;
        endforeach;
        return $output;
    }

    protected function _getModelInstance($modelName)
    {
        list($plugin, $name) = pluginSplit($modelName);
        return (isset($this->{$name}) ? $this->{$name} : TableRegistry::getTableLocator()->get($modelName));
    }
    protected function _buildData($model, $target, $parent)
    {
        return [
            'parent_id' => $parent->parent_id,
            'title' => $target->{$model->getDisplayField()},
            'link' => $parent->link,
            'id' => $target->{$model->getPrimaryKey()}
        ];
    }

    public function formatLink($link, $item)
    {
        $regex = '/\/:([\w]+)/';
        return preg_replace_callback($regex, function ($key) use ($item) {
            $key = end($key);
            return '/' . (!empty($item->{$key}) ? $key . ':' . $item->{$key} : ':' . $key);
        }, $link);
    }
}
