<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function isAuthorized($user)
    {
        if($this->Auth->user()) {
            $session = $this->request->session();
            $permissions = json_decode($session->read('User.Permissions'));

            if ($permissions->user->list == 1) {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }
    
    public function Login()
    {
        if($this->Auth->user()) {
            return $this->redirect("/");
        }

        $sub_page_title = "Login";
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid email or password, try again'));
        }
        $this->set(compact('sub_page_title'));
    }

    public function Logout()
    {
        $session = $this->request->session();
        $session->destroy();
        return $this->redirect($this->Auth->logout());
    }

    public function Register()
    {
        $this->viewBuilder()->layout('no-navigation');
        $sub_page_title = "Register";
        if ($this->request->is('post')) {
            $cuser = $this->Auth->user();
            $post_data = $this->request->data;

            $data = [
                'role_id' => 1,
                'email' => $post_data['email'],
                'password' => $post_data['password'],
                'active' => false,
                'created_by' => ($cuser ? $cuser["id"]: 0),
                'modified_by' => ($cuser ? $cuser["id"]: 0),
                'person' => [
                    'first_name' => $post_data['first_name'],
                    'last_name' => $post_data['last_name'],
                    'email' => $post_data['email'],
                    'created_by' => ($cuser ? $cuser["id"]: 0),
                    'modified_by' => ($cuser ? $cuser["id"]: 0)
                ]
            ];

            $user = $this->Users->newEntity($data, [
                    'associated' => ['People']
                ]);

            if($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'result']);

                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'result']);

            
            $this->set(compact('user'));
            $this->set('_serialize', ['user']);
        }
        $this->set(compact('sub_page_title'));
    }

    public function Profile()
    {
        $sub_page_title = "Register";
        if ($this->request->is('post')) {
            $post_data = $this->request->data;

            $data = [
                'email' => $post_data['email'],
                'password' => $post_data['password'],
                'active' => false,
                'person' => [
                    'first_name' => $post_data['first_name'],
                    'last_name' => $post_data['last_name'],
                    'email' => $post_data['email']
                ]
            ];

            $user = $this->Users->newEntity($data, [
                    'associated' => ['People']
                ]);

            if($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'), ['key' => 'result']);

                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('The user could not be saved. Please, try again.'), ['key' => 'result']);

            
            $this->set(compact('user'));
            $this->set('_serialize', ['user']);
        }
        $this->set(compact('sub_page_title'));
    }

    public function ForgotPassword()
    {
        
    }

    public function GetUserById($id) {
        $user = $this->Users->find('all', [
            'conditions' => ['Users.id' => $id],
            'contain' => ['People']
            ])->select(['id', 'People.first_name', 'People.last_name', 'email', 'role_id', 'active']);

        $this->response->type('json');
        $this->response->body(json_encode($user));
        return $this->response;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sub_page_title = "User List";
        $users = $this->paginate($this->Users->find('all', 
            ['contain' => ['People', 'UserRoles']]
        )->select(['id', 'People.first_name', 'People.last_name', 'email', 'UserRoles.role', 'active']));

        $this->set(compact('users', 'sub_page_title'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['People']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $result = ['status' => 'failed', 'denied'];
        
        if ($this->request->is('post')) {
            $cuser = $this->Auth->user();
            if($cuser) {
                $post_data = $this->request->data;
                $data = [
                        'role_id' => $post_data['role_id'],
                        'email' => $post_data['email'],
                        'active' => $post_data['active'],
                        'created_by' => ($cuser ? $cuser["id"]: 0),
                        'modified_by' => ($cuser ? $cuser["id"]: 0),
                        'person' => [
                            'first_name' => $post_data['first_name'],
                            'last_name' => $post_data['last_name'],
                            'email' => $post_data['email'],
                            'created_by' => ($cuser ? $cuser["id"]: 0),
                            'modified_by' => ($cuser ? $cuser["id"]: 0)
                        ]
                    ];
                $user = $this->Users->newEntity($data, [
                    'associated' => ['People']
                ]);
                
                if($this->Users->save($user)) {
                    $result = ['status' => 'success', 'error_type' => null, 'message' => 'The user has been saved.', 'data' => $user];
                }else{
                    $result = ['status' => 'failed', 'error_type' => 'server-error', 'message' => 'The user could not be created. Please, try again.', 'data' => $user];
                }
            }
        }

        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $result = ['status' => 'failed', 'denied'];
        
        if ($this->request->is('post')) {
            $cuser = $this->Auth->user();
            if($cuser) {
                $post_data = $this->request->data;

                $data = [
                        'role_id' => $post_data['role_id'],
                        'active' => $post_data['active'],
                        'email' => $post_data['email'],
                        'modified_by' => ($cuser ? $cuser["id"]: 0),
                        'person' => [
                            'first_name' => $post_data['first_name'],
                            'last_name' => $post_data['last_name'],
                            'email' => $post_data['email'],
                            'modified_by' => ($cuser ? $cuser["id"]: 0)
                        ]
                    ];

                $user = $this->Users->get($post_data['id'], [
                    'contain' => ['People']
                ]);

                $user = $this->Users->patchEntity($user, $data, [
                    'associated' => ['People']
                    ]);

                if($this->Users->save($user)) {
                    $result = ['status' => 'success', 'error_type' => null, 'message' => 'The user has been updated.', 'data' => $user];
                }else{
                    $result = ['status' => 'failed', 'error_type' => 'server-error', 'message' => 'The user could not be updated. Please, try again.', 'data' => $user];
                }
            }
        }

        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete()
    {
        $result = null;
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($this->request->data['id']);
        if ($this->Users->delete($user)) {
            $result = ['status' => 'success', 'error_type' => null, 'message' => 'The user has been delete.'];
        }else{
            $result = ['status' => 'failed', 'error_type' => 'server-error', 'message' => 'The user could not be deleted. Please, try again.'];
        }

        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;
    }
}
