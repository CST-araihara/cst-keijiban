<?php

use Phpmig\Migration\Migration;

class CreateTableGood extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE good(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            type int(1) NOT NULL,
            target_id int(10) NOT NULL,
            user_id int(10) NOT NULL,
            inserted_date datetime NOT NULL,
            updated_date datetime NULL);";
        $container = $this -> getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DROP TABLE good;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
