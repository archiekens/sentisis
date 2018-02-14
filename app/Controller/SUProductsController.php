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
    public $components = ['Image', 'Paginator'];

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

        if ($this->request->is('POST')) {
            $data = $this->request->data;

            $no_image = false;
            if (!$data['Product']['image']['name']) {
                unset($this->Product->validate['image']);
                $no_image = true;
            }

            // validate image pc, move to tmp if valid
            $image_data = [
                'Product' => ['image' => $data['Product']['image']]
            ];

            if (!$no_image) {
                $this->Product->set($image_data);
                if ($this->Product->validates()) {
                    $tmp_image['tmp_name'] = $this->Image->save($data['Product']['image']['tmp_name'], 'tmp');
                    $tmp_image['name'] = $data['Product']['image']['name'];
                    $tmp_image['type'] = $data['Product']['image']['type'];
                    $tmp_image['size'] = $data['Product']['image']['size'];
                }
            }

            $this->Product->clear();
            $this->Product->set($data);

            if ($this->Product->validates()) {

                unset($data['Product']['image']);

                $product_trans = $this->Product->getDataSource();
                $product_trans->begin();
                $this->Product->clear();

                if ($this->Product->save($data)) {
                    try {
                        $id = $this->Product->getLastInsertID();

                        $update = [
                            'Product.modified' => '"'.date('Y-m-d H:i:s').'"',
                        ];

                        if (!$no_image) {
                            $image_name = $this->Image->save($tmp_image['tmp_name'],'product-add');
                            $update['Product.image'] = '"'.$image_name.'"';
                        }

                        $this->Product->updateAll(
                            $update,
                            ['Product.id' => $id]
                        );

                        $this->Flash->success(__('Successfully registered'));
                        $product_trans->commit();
                        $this->redirect('/SUProducts/index');
                    } catch (Exception $e) {
                        $product_trans->rollback();
                        $this->Flash->fail(__('Failed to register due to system error'));
                    }
                } else {
                    $product_trans->rollback();
                    $this->Flash->fail(__('Failed to register due to system error'));
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
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }

        if ($this->request->is(['post', 'put'])) {

            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $product = $this->Product->find('first', $options);
            $product_image = $product['Product']['image'];
            $this->set(compact('product_image'));

            $data = $this->request->data;

            $this->Product->set($data);

            $no_image = false;
            if (!$data['Product']['image']['name']) {
                unset($this->Product->validate['image']);
                $no_image = true;
            }

            if ($this->Product->validates()) {
                unset($data['Product']['image']);
                $product_trans = $this->Product->getDataSource();
                $product_trans->begin();
                $this->Product->clear();
                $this->Product->id = $id;
                if ($this->Product->save($data)) {
                    try {
                        if (!$no_image) {
                            $image_name = $this->Image->save($this->request->data['Product']['image']['tmp_name'], 'product-edit');
                            $this->Product->updateAll(
                                [
                                    'Product.modified' => '"'.date('Y-m-d H:i:s').'"',
                                    'Product.image' => '"'.$image_name.'"'
                                ],
                                ['Product.id' => $id]
                            );
                            $this->Image->delete($data['Product']['old_image'], 'product');
                        }
                        $this->Flash->success(__('Successfully updated'));
                        $product_trans->commit();
                        $this->redirect('/SUProducts/index');
                    } catch (Exception $e) {
                        $product_trans->rollback();
                        $this->Flash->fail(__('Failed to update due to system error'));
                    }
                } else {
                    $product_trans->rollback();
                    $this->Flash->fail(__('Failed to update due to system error'));
                }
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $this->request->data = $this->Product->find('first', $options);
            $product_image = $this->request->data['Product']['image'];
            $this->set(compact('product_image'));
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
