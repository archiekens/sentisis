<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');
    public $uses = ['Customer','Product'];

/**
 * index method
 *
 * @return void
 */
    public function index() {
        
    }

/**
 * login method
 *
 * @return void
 */
    public function login() {
        if ($this->request->is('POST')) {
            $this->Customer->set($this->request->data);
            if ($this->Customer->validates()) {
                if ($this->Auth->login()) {
                    $this->redirect('customers', 'home');
                } else {
                    $this->Customer->validationErrors['password'][] = 'Email or password is incorrect.';
                }
            } else {

            }
        }
    }

    /**
 * home method
 *
 * @return void
 */
    public function home() {
        $products = $this->Product->find('all', ['conditions' => ['deleted' => 0]]);

        $this->set(compact('products'));
    }

}
