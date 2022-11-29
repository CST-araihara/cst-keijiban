<?php

session_start();

include('../model/userdetail_model.php');

$friend_id = $_GET['friend_id'];

// if (isset($_SESSION['friends'])) {
//     $friends = $_SESSION['friends'];
// }
// else{
//     $friends = kari();
// }
$friends = $_SESSION['friends'];

if (isset($_GET['request'])) {
    request_friends($_SESSION['login'], $_GET['request']);
}
elseif (isset($_GET['request_cancel'])) {
    request_cancel_friends($_SESSION['login'], $_GET['request_cancel']);
}
elseif (isset($_GET['permission'])) {
    request_permission($_SESSION['login'], $_GET['permission']);
}
elseif (isset($_GET['rejection'])) {
    request_rejection($_SESSION['login'], $_GET['rejection']);
}
elseif (isset($_GET['delete'])) {
    delete_friends($_SESSION['login'], $_GET['delete']);
}
elseif (isset($_GET['delete_user'])) {
    delete_user($_GET['delete_user']);
}
elseif (isset($_GET['restoration_user'])) {
    restoration_user($_GET['restoration_user']);
}

foreach($friends as $row) {
    if ($friend_id == $row['id']) {
        $icon = $row['icon_img_path'];
        $handlename = $row['handlename'];
        $login_id = $row['login_id'];
        $comment = $row['comment'];
        $id = $row['id'];
    }
    elseif ($friend_id == $row['your_user_id']) {
        $icon = $row['icon_img_path'];
        $handlename = $row['handlename'];
        $login_id = $row['login_id'];
        $comment = $row['comment'];
        $id = $row['your_user_id'];
    }

    $loginuser_friend = select_friends($id, $_SESSION['login']);
    $loginuser_friendrequest = exist_friendrequest($id, $_SESSION['login']);

    // btn_judge
    // 1=友達申請する,2=友達申請解除する,3=友達を解除する
    // 4=リクエストの可否,5=(管理者のみ)ユーザー削除,6=(管理者のみ)ユーザー復元
    if ($_SESSION['login'] == 1) {
        $select_user = select_user($id);
        foreach ($select_user as $row) {
            $delete_flag = $row['delete_flag'];
        }

        if ($delete_flag == 0) {
            $btn_judge = 5;
        }
        elseif ($delete_flag == 1) {
            $btn_judge = 6;
        }
        
    }
    elseif (!empty($loginuser_friend)) {
        $btn_judge = 3;
    }
    elseif (!empty($loginuser_friendrequest)) {
        foreach ($loginuser_friendrequest as $row2) {
            if ($row2['send_user_id'] == $_SESSION['login']) {
                $btn_judge = 2;
            }
            else {
                $btn_judge = 4;
            }
        }
    }
    else {
        $btn_judge = 1;
    }
}

$count = count_friends($id);

foreach($count as $row) {
    $count = $row['COUNT(*)'];
}

$_SESSION['friends_of_friends'] = array($icon, $handlename, $login_id, $comment, $count, $id, $btn_judge);

header("Location: ../view/userdetail.php");
exit;

?>