<?php
include('PDO_Connect.php');

function insert($login_id, $handlename, $last_name, $first_name, $pw, $dob, $comment, $icon_img_path) {
    $dbh = connect();
    $sql = "INSERT INTO users (login_id,handlename,last_name,first_name,pw,dob,comment,icon_img_path,role,delete_flag,inserted_date) VALUES(:login_id,:handlename,:last_name,:first_name,:pw,:dob,:comment,:icon_img_path,0,0,CURRENT_TIMESTAMP);";
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':login_id',$login_id);
    $sth->bindValue(':handlename',$handlename);
    $sth->bindValue(':last_name',$last_name);
    $sth->bindValue(':first_name',$first_name);
    $sth->bindValue(':pw',$pw);
    $sth->bindValue(':dob',$dob);
    $sth->bindValue(':comment',$comment);
    $sth->bindValue(':icon_img_path',$icon_img_path);
    $sth -> execute();
    print_r($sth -> errorInfo());
}

function select_newuser() {
    $dbh = connect();
    $sql = "SELECT * FROM users WHERE id = (SELECT MAX(id) FROM users);";
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

?>