<?php

use Phpmig\Migration\Migration;

class CreateTableFriendrequest extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE friendrequest(
            id bigint(20) NOT NULL AUTO_INCREMENT,
            send_user_id int(10) NOT NULL,
            receive_user_id int(10) NOT NULL,
            inserted_date DATETIME NOT NULL,
            PRIMARY KEY (id));";
        $container = $this -> getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE friendrequest;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
