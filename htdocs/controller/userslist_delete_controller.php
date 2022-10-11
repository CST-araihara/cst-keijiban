<?php

include('../model/userslist_model.php');

$id = $_GET['id'];

delete_user($id);

$alert = "<script>alert('削除しました。');</script>";
echo $alert;

echo '<script>location.href = "userslist_controller.php" ;</script>'

?>