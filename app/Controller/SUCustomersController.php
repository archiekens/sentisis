<?php
App::uses('AppController', 'Controller');
/**
 * SUCustomers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class SUCustomersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');
    public $uses = ['Customer'];

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $paging = 10;
        $settings = [
            'limit' => 10,
            'fields' => ['*'],
            'paramType' => 'querystring',
            'conditions' => ['deleted' => '0'],
        ];

        $this->Paginator->settings = $settings;
        $customers = $this->Paginator->paginate('Customer');

        $this->set(compact('customers'));
    }

    public function page_ajax() {
        $this->layout = false;
        $paging = 10;
        if ($this->request->is('ajax')) {
            $post_cond  = $this->request->data;

            $conditions['Customer.deleted'] = 0;

            $settings = [
                'fields' => ['*'],
                'paramType' => 'querystring',
                'conditions' => $conditions,
                'limit' => $paging
            ];

            $this->Paginator->settings = $settings;
            $customers = $this->Paginator->paginate('Customer');

        } else {
            throw new MethodNotAllowedException();
        }
        $this->set(compact('customers'));
    }


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Customer->exists($id)) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
        $this->set('customer', $this->Customer->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Customer->validates($this->request->data)) {
                $this->Customer->create();
                if ($this->Customer->save($this->request->data)) {
                    $this->Flash->success(__('The customer has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The customer could not be saved. Please, try again.'));
                }
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
        if (!$this->Customer->exists($id)) {
            throw new NotFoundException(__('Invalid customer'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Customer->validates($this->request->data)) {
                if ($this->Customer->save($this->request->data)) {
                    $this->Flash->success(__('The customer has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The customer could not be saved. Please, try again.'));
                }
            }
        } else {
            $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
            $this->request->data = $this->Customer->find('first', $options);
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
        $this->autoRender = false;
        $this->Customer->id = $id;
        if (!$this->Customer->exists()) {
            throw new NotFoundException(__('Invalid customer'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Customer->delete()) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }
    }
}
