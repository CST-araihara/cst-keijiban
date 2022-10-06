<?php

use Phpmig\Migration\Migration;

class CreateTableFriend extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE friend (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            my_user_id int(10) NOT NULL,
            your_user_id int(10) NOT NULL,
            inserted_date DATETIME NOT NULL,
            updated_date DATETIME NULL,
            PRIMARY KEY (id));";
        $container = $this -> getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE friend;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
