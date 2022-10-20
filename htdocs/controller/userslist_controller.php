<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../view/index.php");
    exit();
}

include('../model/userslist_model.php');

if (isset($_GET['judge']) && isset($_GET['id'])) { // ユーザー削除
    $id = $_GET['id'];

    delete_user($id);

    $alert = "<script>alert('削除しました。');</script>";
    echo $alert;

    echo '<script>location.href = "userslist_controller.php" ;</script>';
}
elseif (!isset($_GET['judge']) && isset($_GET['id'])) { // ユーザー復元
    $id = $_GET['id'];

    restoration_user($id);

    $alert = "<script>alert('復元しました。');</script>";
    echo $alert;

    echo '<script>location.href = "userslist_controller.php" ;</script>';
}
else { // ユーザー一覧
    $users = users();
    $_SESSION['users'] = $users;

    header('Location: ../view/userslist.php');
}

?>