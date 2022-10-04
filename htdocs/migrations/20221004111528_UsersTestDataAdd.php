<?php

use Phpmig\Migration\Migration;

class UsersTestDataAdd extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="
            ALTER TABLE users ADD false_count int(2) NULL;
        ";
        $container = $this -> getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "
            ALTER TABLE users DROP COLuMN false_count;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
