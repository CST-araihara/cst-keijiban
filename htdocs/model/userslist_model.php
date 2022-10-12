<?php
include('PDO_Connect.php');

function users() {
    $dbh = connect();
    $sql = 'SELECT * FROM users WHERE role = 0';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function delete_user($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, delete_flag = 1 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function restoration_user($id) { 
    $dbh = connect();
    $sql = 'UPDATE users SET updated_date = CURRENT_TIMESTAMP, delete_flag = 0 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

?>