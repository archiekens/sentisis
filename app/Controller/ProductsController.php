<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = ['Paginator', 'Rating'];

    public $uses = ['Comment', 'Product'];

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
                'Comment.id',
                'Comment.content',
                'Comment.created',
                'Customer.name',
                'Customer.id'
            ],
            'order' => ['created' => 'DESC']

        ]);
        $tmp_comments = $comments;
        $comments = [];

        foreach ($tmp_comments as $key => $tmp_comment) {
            $comments[$key] = $tmp_comment;
            $comments[$key]['Comment']['category'] = $this->Rating->categorizeComment($tmp_comment['Comment']['content']);
        }

        $this->set(compact('comments'));
    }

}
