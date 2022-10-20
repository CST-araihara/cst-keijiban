<?php
session_start();

include('../model/category_model.php');

$ip = ip();
$_SESSION['ip'] = $ip;

foreach ($ip as $row) {
    if ($_SERVER['REMOTE_ADDR'] == $row['ip_address']) {
        if ($row['block_flag'] == 1) {
            header("Location: ../view/blockip.php");
            exit;
        }
    }
}

$category = category();
$_SESSION['category'] = $category;


if (!isset($_SESSION["login"])) {
    header("Location: ../view/index.php");
    exit();
}

$id = $_SESSION['login'];

header('Location: ../view/index.php');
// exit;

?>