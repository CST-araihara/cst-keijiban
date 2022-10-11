<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../view/index.php");
    exit();
}

include('../model/userslist_model.php');

$users = users();
$_SESSION['users'] = $users;

header('Location: ../view/userslist.php');

?>