<?php

use \Phpmig\Adapter;
use Pimple\Container;

$container = new Container();

$container['db'] = function(){
    $dbh = new PDO('mysql:dbname=board_db;host=192.168.182.135;port=3306;','root','password');
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
