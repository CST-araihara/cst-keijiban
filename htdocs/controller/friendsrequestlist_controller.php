<?php
session_start();

include('../model/friendsrequestlist_model.php');

// $requestfriends =select_requestfriends($_SESSION['login']);

if (isset($_GET['request_cancel'])) {
    request_cancel_friends($_SESSION['login'], $_GET['request_cancel']);
}
elseif (isset($_GET['permission'])) {
    request_permission($_SESSION['login'], $_GET['permission']);
}
elseif (isset($_GET['rejection'])) {
    request_rejection($_SESSION['login'], $_GET['rejection']);
}

$_SESSION['friendsrequest'] = select_requestfriends($_SESSION['login']);

$_SESSION['friends'] = users();

header("Location: ../view/friendsrequestlist.php");
exit;

?>