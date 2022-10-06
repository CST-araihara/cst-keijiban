<?php

use Phpmig\Migration\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE users(
            id int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            login_id varchar(10) NOT NULL,
            handlename varchar(20) NOT NULL,
            last_name varchar(20) NOT NULL,
            first_name varchar(20) NOT NULL,
            pw varchar(16) NOT NULL,
            dob date NOT NULL,
            comment varchar(100) NULL,
            icon_img_path varchar(200) NOT NULL,
            role bit(1) NOT NULL,
            false_count int(2) NULL,
            disable_flag int(1) NULL,
            delete_flag bit(1) NOT NULL,
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
        $sql = "DROP TABLE users;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
