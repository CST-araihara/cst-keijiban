<?php
$dsn      = 'mysql:dbname=board_db;host=mysql_board;port=3306;';
$user     = 'root';
$password = 'password';
 
try {
    $db = new PDO($dsn, $user, $password);
    echo '接続成功';
} catch(PDOException $e) {
    echo '接続失敗' . $e->getMessage();
}

phpinfo();