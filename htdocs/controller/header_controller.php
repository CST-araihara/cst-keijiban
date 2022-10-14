<?php
session_start();

include('../model/category_model.php');

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