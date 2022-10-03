<?php

use Phpmig\Migration\Migration;

class ThreadTestData extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="
        INSERT INTO thread (category_id,title,contents,user_id,datetime,delete_flag,inserted_date) VALUES(1,'1111111111','ああああああああああああああああ',1,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (2,'2222222222','いいいいいいいいいい',2,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (3,'3333333333','うううううううううううう',3,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (4,'4444444444','ええええええええええええええええ',4,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (5,'5555555555','おおおおおおおおお',2,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (3,'6666666666','かきくけこ',3,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (1,'7777777777','さしすせそたちつてと',4,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (2,'8888888888','あかさたな',2,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (3,'9999999999','あいうえおあいうえお',3,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (4,'1000000000','はまやらわん',4,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (5,'2000000000','おこそとの',2,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (3,'3000000000','ほもよろを',3,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP),
            (1,'4000000000','カタカナ',4,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP);
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
        DELETE FROM thread;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
