<?php

session_start();

include('../model/friendslist_model.php');

$id = $_SESSION['login'];

if (isset($_GET['delete'])) {
    delete_friends($id, $_GET['delete']);
}


$_SESSION['friends'] = select_friends($id);

header("Location: ../view/friendslist.php");
exit;

?>