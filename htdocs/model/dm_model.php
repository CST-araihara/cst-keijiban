<?php
include('PDO_Connect.php');

function messages($id, $friend_id) {
    $dbh = connect();
    $sql = 'SELECT
                *
            FROM
                DM
            WHERE
                send_user_id = :id
                AND
                receive_user_id = :friend_id
            OR
                send_user_id = :friend_id
                AND
                receive_user_id = :id
            ;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function friend($friend_id) {
    $dbh = connect();
    $sql = 'SELECT 
                * 
            FROM 
                users 
            WHERE 
                id = :friend_id
            ;
        ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function send_dm($id, $friend_id, $message) {
    $dbh = connect();
    $sql = 'INSERT INTO DM(
                send_user_id
                ,receive_user_id
                ,message
                ,datetime
                ,inserted_date
            )
            VALUES(
                :id
                ,:friend_id
                ,:message
                ,CURRENT_TIMESTAMP
                ,CURRENT_TIMESTAMP
            )
            ;
        ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth->bindValue(':message',$message);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}
?>