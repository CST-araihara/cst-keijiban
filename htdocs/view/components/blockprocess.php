<?php
include('../model/accesshistorylist_model.php');

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
?>