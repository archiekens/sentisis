<?php
App::uses('AppController', 'Controller');
/**
 * SystemUsers Controller
 *
 * @property SystemUser $SystemUser
 * @property PaginatorComponent $Paginator
 */
class SystemUsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = [
        'Rating',
        'Paginator',
        'Auth' => [
            'authenticate'=>[
                'Form' => [
                    'userModel'      => 'SystemUser',
                    'scope'          => ['SystemUser.deleted' => 0],
                    'fields'         => ['username' => 'username'],
                    'passwordHasher' => 'Blowfish'
                ]
            ]
        ]
    ];

    /**
     * beforeFilder method
     *
     * @return void
     */
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
            $this->redirect('dashboard');
        }
        if ($this->request->is('POST')) {
            $this->SystemUser->set($this->request->data);
            if ($this->SystemUser->validates()) {
                if ($this->Auth->login()) {
                    $this->redirect(['action' => 'dashboard']);
                } else {
                    $this->SystemUser->validationErrors['password'][] = 'Username or password is incorrect.';
                }
            } else {

            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

/**
 * dashboard method
 *
 * @return void
 */
    public function dashboard() {

        $dataPoints = $this->Rating->getDataPoints();

        $this->set(compact('dataPoints'));
 
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->SystemUser->exists($id)) {
            throw new NotFoundException(__('Invalid system user'));
        }
        $options = array('conditions' => array('SystemUser.' . $this->SystemUser->primaryKey => $id));
        $this->set('systemUser', $this->SystemUser->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->SystemUser->create();
            if ($this->SystemUser->save($this->request->data)) {
                $this->Flash->success(__('The system user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The system user could not be saved. Please, try again.'));
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
        if (!$this->SystemUser->exists($id)) {
            throw new NotFoundException(__('Invalid system user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->SystemUser->save($this->request->data)) {
                $this->Flash->success(__('The system user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The system user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SystemUser.' . $this->SystemUser->primaryKey => $id));
            $this->request->data = $this->SystemUser->find('first', $options);
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
        $this->SystemUser->id = $id;
        if (!$this->SystemUser->exists()) {
            throw new NotFoundException(__('Invalid system user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->SystemUser->delete()) {
            $this->Flash->success(__('The system user has been deleted.'));
        } else {
            $this->Flash->error(__('The system user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
