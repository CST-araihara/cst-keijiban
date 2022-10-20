<?php
include('PDO_Connect.php');

function ip() {
    $dbh = connect();
    $sql = 'SELECT * FROM ip_address';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function block_ip($id) { 
    $dbh = connect();
    $sql = 'UPDATE ip_address SET updated_date = CURRENT_TIMESTAMP, block_flag = 1 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

function cancellation_ip($id) { 
    $dbh = connect();
    $sql = 'UPDATE ip_address SET updated_date = CURRENT_TIMESTAMP, block_flag = 0 WHERE id = :id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

?>