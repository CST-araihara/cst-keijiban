<?php

include('../model/userslist_model.php');

$id = $_GET['id'];

restoration_user($id);

$alert = "<script>alert('復元しました。');</script>";
echo $alert;

echo '<script>location.href = "userslist_controller.php" ;</script>'

?>