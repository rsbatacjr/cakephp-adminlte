<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'finder' => 'auth',
                        'username' => 'email'
                    ]
                ]
            ],
            'authorize' => ['Controller']
            ]);

        if($this->Auth->user()){
            $this->setUserSession();
        }

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->theme('Adminlte');

        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['Register', 'Login']);
    }

    private function setUserSession()
    {
        $user = $this->Auth->user();
        $session = $this->request->session();

        $people = TableRegistry::get('People');
        $person = $people->find()
            ->where(['user_id' => $user["id"]])
            ->first();

        $roles = TableRegistry::get('UserRoles');
        $role = $roles->get($user['role_id']);

        $session->write([
            'User.FirstName' => $person->first_name,
            'User.FullName' => $person->first_name . ' ' . $person->last_name,
            'User.Photo' => ($person->photo == "" ? 'avatar5.png' : $person->photo),
            'User.Role' => $role->role,
            'User.Permissions' => $role->permissions
            ]);
    }
}
