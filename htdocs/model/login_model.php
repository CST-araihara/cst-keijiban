<?php
function connect() {
    $dsn = 'mysql:dbname=board_db;host=192.168.182.135';
    $user = 'root';
    $password = 'password'; 
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'SELECT * FROM users';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function false_count0($id) { 
    $dsn = 'mysql:dbname=board_db;host=192.168.182.135';
    $user = 'root';
    $password = 'password'; 
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = NULL WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function false_count1($id) { 
    $dsn = 'mysql:dbname=board_db;host=192.168.182.135';
    $user = 'root';
    $password = 'password'; 
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = 1 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function false_count9($id) { 
    $dsn = 'mysql:dbname=board_db;host=192.168.182.135';
    $user = 'root';
    $password = 'password'; 
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = false_count + 1 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function false_count10($id) { 
    $dsn = 'mysql:dbname=board_db;host=192.168.182.135';
    $user = 'root';
    $password = 'password'; 
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = 10, disable_flag = 1  WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function unlock($id) { 
    $dsn = 'mysql:dbname=board_db;host=192.168.182.135';
    $user = 'root';
    $password = 'password'; 
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = null, disable_flag = null  WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}
?>