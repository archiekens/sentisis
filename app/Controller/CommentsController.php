<?php
App::uses('AppController', 'Controller');

/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 */
class CommentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = ['Paginator', 'Rating'];

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Comment->recursive = 0;
        $this->set('comments', $this->Paginator->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Comment->exists($id)) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
        $this->set('comment', $this->Comment->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Comment->create();
            if ($this->Comment->save($data)) {
                $this->Rating->updateRating($data['Comment']['product_id']);
                $this->Flash->success('Comment added');
                $this->redirect('../products/view/'.$data['Comment']['product_id']);
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
                $this->redirect('../products/view/'.$data['Comment']['product_id']);
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
    public function edit() {
        $this->autoRender = false;
        $data = $this->request->data;

        if (!$this->Comment->exists($data['id'])) {
            throw new NotFoundException(__('Invalid comment'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Comment->save($this->request->data)) {
                $this->Rating->updateRating($data['product_id']);
                $this->Flash->success(__('The comment has been updated.'));
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete() {
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $this->Comment->id = $id;
        if (!$this->Comment->exists()) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Comment->delete()) {
            $this->Rating->updateRating($data['product_id']);
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }
    }
}
