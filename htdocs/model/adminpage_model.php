<?php
include('PDO_Connect.php');

function category() {
    $dbh = connect();
    $sql = 'SELECT * FROM category';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function icon($id) {
    $dbh = connect();
    $sql = 'SELECT * FROM users WHERE id = :id';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id', $id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

?>