<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserRoles Controller
 *
 * @property \App\Model\Table\UserRolesTable $UserRoles
 */
class UserRolesController extends AppController
{
    public function isAuthorized($user)
    {
        return true;
    }

    /* Start Private Methods */

    /* End Private Methods */

    /* Data Data Methods */
    public function GetUserRoleOptions()
    {
        $roles = $this->UserRoles
            ->find('all')
            ->select(['id', 'role']);

        $this->response->type('json');
        $this->response->body(json_encode($roles));
        return $this->response;
    }
    /* End Data Methods */

    /* Start View Methods */
    public function index() {
        $roles = $this->paginate($this->UserRoles);

        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }
    /* End View Methods */
}
