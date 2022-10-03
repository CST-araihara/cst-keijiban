<?php

use Phpmig\Migration\Migration;

class Testdata extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="
        INSERT INTO category (category_name,inserted_date) VALUES('暮らし',CURRENT_TIMESTAMP),
            ('恋愛',CURRENT_TIMESTAMP),
            ('お金',CURRENT_TIMESTAMP),
            ('仕事',CURRENT_TIMESTAMP),
            ('雑談',CURRENT_TIMESTAMP);
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
        DELETE FROM category;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
