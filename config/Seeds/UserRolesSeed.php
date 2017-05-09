<?php
use Migrations\AbstractSeed;

/**
 * UserRoles seed.
 */
class UserRolesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1, 
                'role' => 'Admin', 
                'permissions' => '{"user": {"list": 1, "add": 1, "update": 1, "delete": 1}}', 
                'created' => date('Y-m-d H:i:s'), 
                    'modified' => date('Y-m-d H:i:s')]
        ];

        $table = $this->table('user_roles');
        $table->insert($data)->save();
    }
}
