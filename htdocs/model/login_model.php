<?php
include('PDO_Connect.php');

function select() {
    $dbh = connect();
    $sql = 'SELECT * FROM users WHERE delete_flag = 0';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function false_count0($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = NULL WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function false_count1($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = 1 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function false_count9($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = false_count + 1 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function false_count10($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = 10, disable_flag = 1  WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function unlock($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, false_count = null, disable_flag = null  WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}
?>