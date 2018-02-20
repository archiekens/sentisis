<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package     app.Controller
 * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * components
     *
     * @var array
     */
    public $components = [
        'Flash',
        'DebugKit.Toolbar',
        'Auth'
    ];

    public $product_types = [
        'Phone',
        'Tablet',
        'Earphones',
        'Camera',
        'Laptop'
    ];

    /**
     * beforeFilder method
     *
     * @return void
     */
    public function beforeFilter() {
        $page_type = 1; //1 : admin, 2: customer
        $controller_action = $this->request->params['action'];
        $controller_controller = $this->request->params['controller'];

        switch ($controller_controller) {
            case 'customers':
                $page_type = 2;
                break;
            case 'products':
                $page_type = 2;
                break;
            case 'comments':
                $page_type = 2;
                break;
        }

        if ($page_type == 1) {
            AuthComponent::$sessionKey  = 'Auth.SystemUser';
            $this->Auth->loginAction    = ['controller' => 'system_users', 'action' => 'login'];
            $this->Auth->loginRedirect  = ['controller' => 'system_users', 'action' => 'dashboard'];
            $this->Auth->logoutRedirect = ['controller' => 'system_users', 'action' => 'login'];
        } else {
            AuthComponent::$sessionKey  = 'Auth.Customer';
            $this->Auth->loginAction    = ['controller' => 'customers', 'action' => 'login'];
            $this->Auth->loginRedirect  = ['controller' => 'customers', 'action' => 'home'];
            $this->Auth->logoutRedirect = ['controller' => 'customers', 'action' => 'login'];
        }

        $this->set('product_types', $this->product_types);
        $this->set('page_type', $page_type);
    }
}
