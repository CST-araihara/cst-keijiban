<?php

use Phpmig\Migration\Migration;

class DmTestData extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="INSERT INTO DM(
                send_user_id
                ,receive_user_id
                ,message
                ,datetime
                ,inserted_date
            )
            VALUES(
                2
                ,3
                ,'こんにちは'
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ,(
                3
                ,2
                ,'はじめましてこんにちは'
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ,(
                2
                ,3
                ,'よろしくお願いします'
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ,(
                3
                ,2
                ,'こちらこそよろしくお願いします'
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ,(
                3
                ,2
                ,'友達申請ありがとうございました'
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ,(
                2
                ,3
                ,'ありがとうございました'
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ;
        ";
        $container = $this -> getContainer();
        $container['db']->query($sql);
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        $sql = "DELETE FROM DM;";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
