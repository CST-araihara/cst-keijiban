<?php
include('PDO_Connect.php');

function update($id, $handlename, $pw, $comment, $icon_img_path) {
    $dbh = connect();
    $sql = "UPDATE users set handlename = :handlename, pw = :pw, comment = :comment, icon_img_path = :icon_img_path, updated_date = CURRENT_TIMESTAMP where id = :id;";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':handlename',$handlename);
    $sth->bindValue(':pw',$pw);
    $sth->bindValue(':comment',$comment);
    $sth->bindValue(':icon_img_path',$icon_img_path);
    $sth -> execute();
}

function select_user($id) {
    $dbh = connect();
    $sql = "SELECT * FROM users WHERE id = :id";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}
?>