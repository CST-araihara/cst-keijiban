<?php

use Phpmig\Migration\Migration;

class UsersTestData extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $sql ="
        INSERT INTO users (login_id,handlename,last_name,first_name,pw,dob,comment,icon_img_path,role,delete_flag,inserted_date) VALUES('admin0000','管理者','管理者','管理者','kanri','2000-01-01','ひとこと','cst-keijiban/htdocs/view/image/f_f_event_3_s128_f_event_3_2bg.png',1,0,CURRENT_TIMESTAMP),
            ('araihara','新玲','新井原','玲衣','abc','2000-01-02','ひとこと','cst-keijiban/htdocs/view/image/f_f_event_3_s128_f_event_3_2bg.png',0,0,CURRENT_TIMESTAMP),
            ('oshima','大涼','大嶋','涼巴','def','2000-01-03','ひとこと','cst-keijiban/htdocs/view/image/f_f_event_3_s128_f_event_3_2bg.png',0,0,CURRENT_TIMESTAMP),
            ('takemasa','竹勇','竹政','勇輝','ghi','2000-01-04','ひとこと','cst-keijiban/htdocs/view/image/f_f_event_3_s128_f_event_3_2bg.png',0,0,CURRENT_TIMESTAMP);
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
        DELETE FROM users;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
