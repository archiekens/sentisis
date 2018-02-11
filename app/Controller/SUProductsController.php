<?php
App::uses('AppController', 'Controller');
/**
 * SUProducts Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class SUProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');

    public $uses = ['Comment', 'Product'];

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $products = [];
        $products = $this->Product->find('all', ['conditions' => ['deleted' => 0]]);
        $this->set(compact('products'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        $comments = [];
        $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
        $this->set('product', $this->Product->find('first', $options));
        $comments = $this->Comment->find('all', [
            'joins' => [
                [
                    'table' => 'customers',
                    'alias' => 'Customer',
                    'type' => 'INNER',
                    'conditions' => [
                        'Customer.id = Comment.customer_id',
                        'Customer.deleted = 0'
                    ]
                ]
            ],
            'conditions' => [
                'Comment.product_id' => $id,
                'Comment.deleted' => 0
            ],
            'fields' => [
                'Comment.content',
                'Comment.created',
                'Customer.name'
            ],
            'order' => ['created' => 'DESC']

        ]);
        $this->set(compact('comments'));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Product->create();
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $this->request->data = $this->Product->find('first', $options);
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Product->delete()) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
