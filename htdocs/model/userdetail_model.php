<?php
include('PDO_Connect.php');

// セッション用仮関数（後で消す）
// function kari() {
//     $dbh = connect();
//     $sql = 'SELECT
//                 *
//             FROM
//                 users;
//             ';
//     $sth = $dbh->prepare($sql);
//     $sth -> execute();

//     $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
//     return $aryList;
// }

function select_user($id) {
    $dbh = connect();
    $sql = 'SELECT
                *
            FROM
                users;
            WHERE
                id = :id
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

// 友達の人数をカウント
function count_friends($id) {
    $dbh = connect();
    $sql = 'SELECT 
                COUNT(*)
            FROM 
                friend
            INNER JOIN 
                users
            ON 
                friend.your_user_id = users.id
            WHERE 
                my_user_id = :id
            AND 
                delete_flag = 0;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

// 友達をselect
function select_friends($id, $login_id) {
    $dbh = connect();
    $sql = 'SELECT
                your_user_id
                , login_id
                , handlename
                , comment
                , icon_img_path
            FROM
                friend
            INNER JOIN
                users
            ON 
                friend.your_user_id = users.id
            WHERE 
                my_user_id = :login_id
            AND 
                your_user_id = :id
            AND 
                delete_flag = 0;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':login_id',$login_id);
    $sth -> execute();
    
    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

// 友達申請の有無
function exist_friendrequest($id, $login_id) {
    $dbh = connect();
    $sql = 'SELECT
                send_user_id
                , receive_user_id
            FROM
                friendrequest
            WHERE
                (send_user_id = :login_id AND receive_user_id = :id)
            OR
                (send_user_id = :id AND receive_user_id = :login_id);
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':login_id',$login_id);
    $sth -> execute();
    
    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

// 友達を削除
function delete_friends($id, $friend_id) {
    $dbh = connect();
    $sql = 'DELETE
            FROM
                friend
            WHERE
                my_user_id = :id
            AND
                your_user_id = :friend_id;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();

    $dbh2 = connect();
    $sql2 = 'DELETE
            FROM
                friend
            WHERE
                my_user_id = :friend_id
            AND
                your_user_id = :id;
            ';
    $sth2 = $dbh2->prepare($sql2);
    $sth2->bindValue(':id',$id);
    $sth2->bindValue(':friend_id',$friend_id);
    $sth2 -> execute();
}

// 友達申請する
function request_friends($id, $friend_id) {
    $dbh = connect();
    $sql = 'INSERT INTO friendrequest
                (send_user_id
                , receive_user_id
                , inserted_date)
            VALUES
                (:id
                , :friend_id
                , CURRENT_TIMESTAMP);
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth->bindValue(':friend_id',$friend_id);
    $sth -> execute();
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

// ユーザーの削除
function delete_user($id) { 
    $dbh = connect();
    $sql = 'UPDATE
                users 
            SET
                updated_date = CURRENT_TIMESTAMP
                , delete_flag = 1
            WHERE id = :id
            ;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}

// ユーザーの復元
function restoration_user($id) { 
    $dbh = connect();
    $sql = 'UPDATE
                users
            SET
                updated_date = CURRENT_TIMESTAMP
                , delete_flag = 0
            WHERE id = :id
            ;';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':id',$id);
    $sth -> execute();
}
?>