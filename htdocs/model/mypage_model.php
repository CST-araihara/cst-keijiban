<?php
include('PDO_Connect.php');

function count_friends($id) {
    $dbh = connect();
    $sql = 'SELECT COUNT(*) FROM friend INNER JOIN users ON friend.your_user_id = users.id WHERE my_user_id = :id AND delete_flag = 0;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}
?>