<?php

session_start();

$friend_id = $_GET['friend_id'];

$friends = $_SESSION['friends'];

foreach($friends as $row) {
    if ($friend_id == $row['your_user_id']) {
        $icon = $row['icon_img_path'];
        $handlename = $row['handlename'];
        $login_id = $row['login_id'];
        $comment = $row['comment'];
        $id = $row['your_user_id'];
    }
}

include('../model/mypage_model.php');

$count = count_friends($id);

foreach($count as $row) {
    $count = $row['COUNT(*)'];
}

$_SESSION['friends_of_friends'] = array($icon, $handlename, $login_id, $comment, $count, $id);

header("Location: ../view/userdetail.php");
exit;

?>