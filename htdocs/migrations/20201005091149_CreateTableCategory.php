<?php

use Phpmig\Migration\Migration;

class CreateTableCategory extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE category(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            category_name varchar(30) NOT NULL,
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
        $sql = "DROP TABLE category;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
