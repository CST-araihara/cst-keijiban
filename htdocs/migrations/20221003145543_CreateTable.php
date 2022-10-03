<?php

use Phpmig\Migration\Migration;

class CreateTable extends Migration
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
            delete_flag bit(1) NOT NULL,
            inserted_date datetime NOT NULL,
            updated_date datetime NULL
        );

        CREATE TABLE category(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            category_name varchar(30) NOT NULL,
            inserted_date datetime NOT NULL,
            updated_date datetime NULL
        );

        CREATE TABLE thread(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            category_id int(2) NOT NULL,
            title varchar(100) NOT NULL,
            contents varchar(5000) NOT NULL,
            upload_file_path varchar(200) NULL,
            user_id int(10) NOT NULL,
            datetime datetime NOT NULL,
            delete_flag bit(1) NOT NULL,
            inserted_date datetime NOT NULL,
            updated_date datetime NULL
        );

        CREATE TABLE response(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            thread_id int(2) NOT NULL,
            contents varchar(5000) NOT NULL,
            upload_file_path varchar(200) NULL,
            user_id int(10) NOT NULL,
            datetime datetime NOT NULL,
            delete_flag bit(1) NOT NULL,
            inserted_date datetime NOT NULL,
            updated_date datetime NULL
        );

        CREATE TABLE good(
            id int(2) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            type int(1) NOT NULL,
            target_id int(10) NOT NULL,
            user_id int(10) NOT NULL,
            inserted_date datetime NOT NULL,
            updated_date datetime NULL
        );

        CREATE TABLE friendrequest(
            id bigint(20) NOT NULL AUTO_INCREMENT,
            send_user_id int(10) NOT NULL,
            receive_user_id int(10) NOT NULL,
            inserted_date DATETIME NOT NULL,
            PRIMARY KEY (id)
        );

        CREATE TABLE DM (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            send_user_id int(10) NOT NULL,
            receive_user_id int(10) NOT NULL,
            message varchar(100) NOT NULL,
            datetime datetime NOT NULL,
            inserted_date DATETIME NOT NULL,
            updated_date DATETIME NULL,
            PRIMARY KEY (id)
        );

        CREATE TABLE ip_address (
            id int(10) NOT NULL AUTO_INCREMENT,
            ip_address varchar(15) NOT NULL,
            datetime datetime NOT NULL,
            block_flag bit(1) NOT NULL,
            inserted_date DATETIME NOT NULL,
            updated_date DATETIME NULL,
            PRIMARY KEY (id)
        );

        CREATE TABLE friend (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            my_user_id int(10) NOT NULL,
            your_user_id int(10) NOT NULL,
            inserted_date DATETIME NOT NULL,
            updated_date DATETIME NULL,
            PRIMARY KEY (id)
        );
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
            DROP TABLE users;
            DROP TABLE category;
            DROP TABLE thread;
            DROP TABLE response;
            DROP TABLE good;
            DROP TABLE friendrequest;
            DROP TABLE DM;
            DROP TABLE ip_address;
            DROP TABLE friend;
        ";
        $container = $this->getContainer();
        $container['db']->query($sql);
    }
}
