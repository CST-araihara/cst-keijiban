<?php

use Phpmig\Migration\Migration;

class UsersTestDataAdd2 extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="
            ALTER TABLE users ADD disable_flag int(1) NULL;
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
            ALTER TABLE users DROP COLuMN disable_flag;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
