<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../view/index.php");
    exit();
}

include('../model/adminpage_model.php');

$category = category();
$_SESSION['category'] = $category;

$id = $_SESSION['login'];

header('Location: ../view/adminpage.php');

?>