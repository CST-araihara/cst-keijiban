<?php
session_start();

include('../model/adminpage_model.php');

$category = category();
$_SESSION['category'] = $category;

$id = $_SESSION['login'];

$icon = icon($id);
$_SESSION['icon'] = $icon;

?>