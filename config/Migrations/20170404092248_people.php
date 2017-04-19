<?php

use Phinx\Migration\AbstractMigration;

class People extends AbstractMigration
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
        $table = $this->table('people');

        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('first_name', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => false,
        ]);

        $table->addColumn('middle_name', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => true,
        ]);

        $table->addColumn('last_name', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => false,
        ]);

        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 128,
            'null' => false,
        ])->addIndex(['id', 'email']);

        $table->addColumn('birth_date', 'date', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('gender', 'string', [
            'default' => null,
            'limit' => 8,
            'null' => true,
        ]);

        $table->addColumn('photo', 'string', [
            'default' => null,
            'limit' => 512,
            'null' => true,
        ]);

        $table->create();
    }
}
