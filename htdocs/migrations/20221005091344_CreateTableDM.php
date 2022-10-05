<?php

use Phpmig\Migration\Migration;

class CreateTableDM extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE DM (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            send_user_id int(10) NOT NULL,
            receive_user_id int(10) NOT NULL,
            message varchar(100) NOT NULL,
            datetime datetime NOT NULL,
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
        $sql = "DROP TABLE DM;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
