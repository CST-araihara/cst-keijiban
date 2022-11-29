<?php
include('PDO_Connect.php');

// 友達をselect
function select_requestfriends($id) {
    $dbh = connect();
    $sql = 'SELECT
                send_user_id
                , receive_user_id
                ,(  SELECT
                        handlename
                    FROM
                        users
                    WHERE
                        id = send_user_id
                )
                AS send_user_name
                ,(  SELECT
                        handlename
                    FROM
                        users
                    WHERE
                        id = receive_user_id
                )
                AS receive_user_name
            FROM
                friendrequest
            WHERE
                send_user_id = :id
            OR
                receive_user_id = :id;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

function users() {
    $dbh = connect();
    $sql = 'SELECT
                *
            FROM
                users
            ';
    $sth = $dbh->prepare($sql);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

// 友達申請を解除
function request_cancel_friends($id, $friend_id) {
    $dbh = connect();
    $sql = 'DELETE
            FROM
                friendrequest
            WHERE
                send_user_id = :id
            AND
                receive_user_id = :friend_id;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();
}

// 友達リクエストを許可して友達になる
function request_permission($id, $friend_id) {
    $dbh = connect();
    $sql = 'DELETE
            FROM
                friendrequest
            WHERE
                send_user_id = :friend_id
            AND
                receive_user_id = :id;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();

    $dbh2 = connect();
    $sql2 = 'INSERT INTO friend
                (my_user_id
                , your_user_id
                , inserted_date)
            VALUES
                (:id
                , :friend_id
                , CURRENT_TIMESTAMP);
            ';
    $sth2 = $dbh2->prepare($sql2);
    $sth2->bindValue(':id',$id);
    $sth2->bindValue(':friend_id',$friend_id);
    $sth2 -> execute();

    $dbh3 = connect();
    $sql3 = 'INSERT INTO friend
                (my_user_id
                , your_user_id
                , inserted_date)
            VALUES
                (:friend_id
                , :id
                , CURRENT_TIMESTAMP);
            ';
    $sth3 = $dbh3->prepare($sql3);
    $sth3->bindValue(':id',$id);
    $sth3->bindValue(':friend_id',$friend_id);
    $sth3 -> execute();
}

// 友達リクエストを拒否
function request_rejection($id, $friend_id) {
    $dbh = connect();
    $sql = 'DELETE
            FROM
                friendrequest
            WHERE
                send_user_id = :friend_id
            AND
                receive_user_id = :id;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();
}

?>