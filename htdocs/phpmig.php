<?php

use \Phpmig\Adapter;
use Pimple\Container;

include('config/PDO_config.php');

$container = new Container();

$container['db'] = function(){
    $dsn = sprintf('mysql:dbname=%s;host=%s;port=3306;'
        ,constant('MYSQL_DBNAME')
        ,constant('MYSQL_HOST')
    );

    $dbh = new PDO($dsn, constant('MYSQL_USER'), constant('MYSQL_PASSWORD'));
    // $dbh = new PDO('mysql:dbname=board_db;host=192.168.182.139;port=3306;','root','password');
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
};

// replace this with a better Phpmig\Adapter\AdapterInterface
$container['phpmig.adapter'] = function ($container){
    return new Phpmig\Adapter\PDO\Sql($container['db'], 'migrations');
};

$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

// You can also provide an array of migration files
// $container['phpmig.migrations'] = array_merge(
//     glob('migrations_1/*.php'),
//     glob('migrations_2/*.php')
// );
//
//
return $container;
