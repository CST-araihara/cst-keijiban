<?php

session_start();

include('../model/dm_model.php');

$my_id = $_SESSION['login'];

if (isset($_GET['friend_id'])) {
    $friend_id = $_GET['friend_id'];
    $friend = friend($friend_id);

    foreach($friend as $row) {
        $icon = $row['icon_img_path'];
        $handlename = $row['handlename'];
        $login_id = $row['login_id'];
        $comment = $row['comment'];
        $id = $row['id'];
    }

    $_SESSION['friends_of_friends'] = array($icon, $handlename, $login_id, $comment, $count, $id);
}
else {
    $friend_id = $_SESSION['friends_of_friends'][5];
}

if ($_POST['dm_message'] != NULL) {
    send_dm($my_id, $friend_id, $_POST['dm_message']);
}

$_SESSION['DM'] = messages($my_id, $friend_id);

header("Location: ../view/dm.php");
exit;
?>