<?php

session_start();

include('../model/mypage_model.php');

$id = $_SESSION['login'];

$_SESSION['count_friends'] = count_friends($id);

header("Location: ../view/mypage.php");
exit;

?>