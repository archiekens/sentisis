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
    public $components = [
        'Paginator',
        'Auth' => [
            'authenticate'=>[
                'Form' => [
                    'userModel'      => 'Customer',
                    'fields'         => ['username' => 'email', 'password' => 'password'],
                    'scope'          => ['Customer.deleted' => 0],
                    'passwordHasher' => 'Blowfish'
                ]
            ]
        ]
    ];
    public $uses = ['Customer','Product'];

    public function beforeFilter() {
        parent::beforeFilter();
    }

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
        if ($this->Auth->user()) {
            $this->redirect('home');
        }
        if ($this->request->is('POST')) {
            $this->Customer->set($this->request->data);
            if ($this->Customer->validates()) {
                if ($this->Auth->login()) {
                    $this->redirect(['action' => 'home']);
                } else {
                    $this->Customer->validationErrors['password'][] = 'Email or password is incorrect.';
                }
            } else {

            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
 * home method
 *
 * @return void
 */
    public function home() {
        $this->__getBrands();
        $paging = 15;
        $settings = [
            'limit' => 15,
            'fields' => ['*'],
            'paramType' => 'querystring',
            'conditions' => ['deleted' => '0'],
            'order' => ['id' => 'DESC'],
        ];

        $this->Paginator->settings = $settings;
        $products = $this->Paginator->paginate('Product');

        $this->set(compact('products'));
    }

    public function page_ajax() {
        $this->layout = false;
        $paging = 15;
        if ($this->request->is('ajax')) {
            $post_cond  = $this->request->data;

            $conditions['Product.deleted'] = 0;
            if (isset($post_cond['Product']['type']) && $post_cond['Product']['type'] != 'null') {
                $conditions['Product.type'] = $post_cond['Product']['type'];
            }

            if (isset($post_cond['Product']['brand_array']) && $post_cond['Product']['brand_array'] != '') {
                $brands = explode(",",$post_cond['Product']['brand_array']);
                $conditions['Product.brand'] = $brands;
                $this->set(compact('brands'));
            }

            if (isset($post_cond['Product']['rating']) && $post_cond['Product']['rating'] != 'null') {
                if ( $post_cond['Product']['rating'] != 0) {
                    $conditions['Product.rating >='] = $post_cond['Product']['rating'];
                } else {
                    $conditions['Product.rating'] = $post_cond['Product']['rating'];
                }
                $this->set('rating', $post_cond['Product']['rating']);
            }

            $settings = [
                'fields' => ['*'],
                'paramType' => 'querystring',
                'conditions' => $conditions,
                'limit' => $paging,
                'order' => ['id' => 'DESC'],
            ];

            $this->Paginator->settings = $settings;
            $products = $this->Paginator->paginate('Product');
            
        } else {
            throw new MethodNotAllowedException();
        }
        $this->set(compact('products'));
    }

    private function __getBrands() {
        $brands = $this->Product->find('list', [
            'conditions' => ['deleted' => 0],
            'group' => 'brand',
            'fields' => 'brand',
            'order' => ['brand' => 'ASC']
        ]);
        $this->set(compact('brands'));
    }

/**
 * register method
 *
 * @return void
 */
    public function register() {
        if ($this->Auth->user()) {
            $this->redirect('/customers/home');
        }
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Customer->set($data);
            if ($this->Customer->validates()) {
                $this->Customer->create();
                if ($this->Customer->save($data)) {
                    $this->Flash->success(__('You have successfully registered'));
                    return $this->redirect(array('action' => 'login'));
                } else {
                    $this->Flash->error(__('The customer could not be saved. Please, try again.'));
                }
            }
        }
    }

}
