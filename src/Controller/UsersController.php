<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function isAuthorized($user)
    {
        return true;
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
                $session = $this->request->session();
                
                $this->Auth->setUser($user);

                $people = TableRegistry::get('People');
                $person = $people->find()
                    ->where(['user_id' => 1])
                    ->first();
                $session->write([
                    'User.FirstName' => $person->first_name,
                    'User.FullName' => $person->first_name . ' ' . $person->last_name,
                    'User.Photo' => ($person->photo == "" ? 'avatar5.png' : $person->photo)
                    ]);

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

    public function Profile()
    {
        $sub_page_title = "Register";
        $this->set(compact('sub_page_title'));
    }

    public function ForgotPassword()
    {
        
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
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
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
