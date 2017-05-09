<?php

use Phinx\Migration\AbstractMigration;

class UserRoles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('user_roles');

        $table->addColumn('role', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => false
        ])->addIndex(['role']);

        $table->addColumn('permissions', 'text', [
        	'default' => null,
        	'null' => false
    	]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('created_by', 'integer', [
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false
        ]);

        $table->addColumn('modified_by', 'integer', [
            'default' => null,
            'null' => true
        ]);

        $table->create();
    }
}
