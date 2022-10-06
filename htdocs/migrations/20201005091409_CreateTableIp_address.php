<?php

use Phpmig\Migration\Migration;

class CreateTableIpAddress extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE ip_address (
            id int(10) NOT NULL AUTO_INCREMENT,
            ip_address varchar(15) NOT NULL,
            datetime datetime NOT NULL,
            block_flag bit(1) NOT NULL,
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
        $sql = "DROP TABLE ip_address;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
