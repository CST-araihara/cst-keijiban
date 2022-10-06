<?php

use Phpmig\Migration\Migration;

class CreateTableThread extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="CREATE TABLE thread(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            category_id int(2) NOT NULL,
            title varchar(100) NOT NULL,
            contents varchar(5000) NOT NULL,
            upload_file_path varchar(200) NULL,
            user_id int(10) NOT NULL,
            datetime datetime NOT NULL,
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
        $sql = "DROP TABLE thread;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
