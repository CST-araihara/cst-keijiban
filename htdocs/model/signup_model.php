<?php
include('PDO_Connect.php');

function select() {
    $dbh = connect();
    $sql = 'SELECT * FROM users';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

?>