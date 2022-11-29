<?php
include('PDO_Connect.php');

function select_friends($id) {
    $dbh = connect();
    $sql = 'SELECT your_user_id, login_id, handlename, comment, icon_img_path FROM friend INNER JOIN users ON friend.your_user_id = users.id WHERE my_user_id = :id AND delete_flag = 0;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function delete_friends($id, $friend_id) {
    $dbh = connect();
    $sql = 'DELETE FROM friend WHERE my_user_id = :id AND your_user_id = :friend_id;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();

    $dbh2 = connect();
    $sql2 = 'DELETE FROM friend WHERE my_user_id = :friend_id AND your_user_id = :id;';
    $sth2 = $dbh2->prepare($sql2);
    $sth2->bindValue(':id',$id);
    $sth2->bindValue(':friend_id',$friend_id);
    $sth2 -> execute();
}

?>