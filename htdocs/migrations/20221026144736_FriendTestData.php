<?php

use Phpmig\Migration\Migration;

class FriendTestData extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="
        INSERT INTO friend (my_user_id, your_user_id, inserted_date) VALUES (2, 3, CURRENT_TIMESTAMP),
            (3, 2, CURRENT_TIMESTAMP),
            (3, 4, CURRENT_TIMESTAMP),
            (4, 3, CURRENT_TIMESTAMP),
            (3, 5, CURRENT_TIMESTAMP),
            (5, 3, CURRENT_TIMESTAMP),
            (2, 6, CURRENT_TIMESTAMP),
            (6, 2, CURRENT_TIMESTAMP),
            (2, 7, CURRENT_TIMESTAMP),
            (7, 2, CURRENT_TIMESTAMP),
            (2, 8, CURRENT_TIMESTAMP),
            (8, 2, CURRENT_TIMESTAMP);
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
        DELETE FROM friend;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
