<?php

declare(strict_types=1);

namespace Menus\Controller\Admin;

use Cake\Routing\Route\Route;
use App\Routing\Router;

use function PHPSTORM_META\map;

/**
 * Items Controller
 *
 * @property \Menus\Model\Table\ItemsTable $Items
 * @property  \App\Controller\Component\RouteMapComponent $routeMap
 * 
 * @method \Menus\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * 
 */
class ItemsController extends AppController
{


    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $menu = (int)current($this->request->getParam('pass'));
        $menu = $this->Items->Menus->find()->select(['id', 'title'])->where(['id' => $menu])->first();

        if (!$menu) {
            return $this->redirect(['controller' => 'menus', 'action' => 'index']);
        }

        $this->set(compact('menu'));
        $this->redirectTarget['action'] = 'index';
        $this->redirectTarget['target'] = $menu->id;
    }

    protected function _getRequestTargetRegex(array $useRouteKeys = [])
    {
        $useRouteKeys += ['prefix', 'plugin', 'controller', 'action'];
        $params = $this->request->getAttribute('params');
        foreach ($params as $key => $val) {
            if (is_array($val) || !in_array($key, $useRouteKeys))
                unset($params[$key]);
        }
        return '/' . implode('|', $params) . '/';
    }

    public function links($menu_id = null, $status = 1)
    {
        //$this->disableAutoRender();
        $this->_getRequestTargetRegex();
        $rows = $this->Items->findTreeByMenuSlug('admin');
      //debug($rows);
        $this->set(compact('rows'));
        //debug($rows);
        /* $this->loadComponent('RouteMap');
 
        $links = $this->RouteMap->loadAll();
       */
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($menu_id = null)
    {
        $options['finder'] = 'filtred';
        $options['order'] = ['Items.lft' => 'asc'];
        $options['contain']['Users'] = ['fields' => ['Users.username']];
        $options['contain']['ParentItems'] = ['fields' => ['ParentItems.title', 'ParentItems.id']];
        $options['conditions'] = ['Items.menu_id' => $menu_id];

        $this->paginate += $options;
        parent::_read($this->Items);
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($menu_id = null, $id = null)
    {
        $item = $this->Items->get($id, [
            'contain' => ['Menus' => ['conditions' => compact('menu_id')], 'Users'],
        ]);

        $this->set('item', $item);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($menu_id = null)
    {
        $this->Items->recover();
        parent::_create($this->Items);
        $this->_setToViewListOptions($menu_id);
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($menu_id = null, $id = null)
    {
        parent::_update($this->Items, compact('id'));
        $this->_setToViewListOptions($menu_id, $id);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        parent::_delete($this->Items, compact('id'));
    }

    protected function _setToViewListOptions($menu_id, $id = null)
    {
        $options = ['spacer' => '-'];
        $options['conditions']['menu_id'] = $menu_id;

        if ($id) {
            $options['conditions']['id !='] = $id;
        }
        $models = $this->Items->findAllModels();
        $parents = $this->Items->ParentItems->find('treeList', $options)->toArray();

        $this->set(compact('parents','models'));
    }
}
