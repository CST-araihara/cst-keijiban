<?php

use Phpmig\Migration\Migration;

class Testdata extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="INSERT INTO category (category_name,inserted_date,main_colorcode,sub_colorcode) 
            VALUES('暮らし',CURRENT_TIMESTAMP,'#eaffea','#ccffcc'),
            ('恋愛',CURRENT_TIMESTAMP,'#ffeaff','#ffccff'),
            ('お金',CURRENT_TIMESTAMP,'#ffffd6','#ffff84'),
            ('仕事',CURRENT_TIMESTAMP,'#e0ffff','#adffff'),
            ('雑談',CURRENT_TIMESTAMP,'#ffeddb','#ffdbb7');
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
