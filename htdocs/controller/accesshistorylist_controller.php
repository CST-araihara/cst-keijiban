<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../view/index.php");
    exit();
}

include('../model/accesshistorylist_model.php');

if (isset($_GET['judge']) && isset($_GET['id'])) { // IPブロック
    $id = $_GET['id'];

    block_ip($id);

    $alert = "<script>alert('ブロックしました。');</script>";
    echo $alert;

    echo '<script>location.href = "accesshistorylist_controller.php" ;</script>';
}
elseif (!isset($_GET['judge']) && isset($_GET['id'])) { // IP解除
    $id = $_GET['id'];

    cancellation_ip($id);

    $alert = "<script>alert('解除しました。');</script>";
    echo $alert;

    echo '<script>location.href = "accesshistorylist_controller.php" ;</script>';
}
else { // 一覧表示
    $ip = ip();
    $_SESSION['ip'] = $ip;

    header('Location: ../view/accesshistorylist.php');
}

?>