<?php
session_start();

if(isset($_SESSION['login'])) {
    session_regenerate_id(TRUE);
    // header('Location: ../view/login.php');
    // exit();
}

$login_id = $_POST['login_id'];
$pw = $_POST['pw'];

include('../model/login_model.php');

$connect = connect();
$_SESSION['connect'] = $connect;

foreach($connect as $row) {
    $date_30s = date("Y-m-d H:i:s",strtotime("-30 second"));
    $id = $row['id'];

    if ($login_id == $row['login_id']) {
        if ($row['disable_flag'] == 1) { // ロック済
            if ($date_30s > $row['updated_date']) {
                unlock($id);
            }

            $mes =urlencode("アカウントはロックされました。<br>30秒後に再度お試しください。");
            $i = urlencode($login_id);
            $p = urlencode($pw);
        }
        elseif ($pw == $row['pw']) { // ログイン
            session_regenerate_id(TRUE);
            $_SESSION['login'] = $row['id'];
            $_SESSION['handlename'] = $row['handlename'];
            $_SESSION['login_id'] = $row['login_id'];

            if ($row['role'] == 1) {
                false_count0($id);
                header('Location: ../view/adminpage.php');
            }
            elseif ($row['role'] == 0) {
                false_count0($id);
                header('Location: ../view/mypage.php');
            }
            exit();
        }
        elseif ($pw == "") {
            $mes =urlencode("PWが未入力です。");
            $i = urlencode($login_id);
        }
        else { // PWがNG
            // カウント数により分岐
            if ($row['false_count'] == NULL) {
                false_count1($id);
            }
            elseif ($row['false_count'] == 9) {
                false_count10($id);
            }
            else {
                false_count9($id);
            }
            $mes =urlencode("IDもしくはPWが正しくありません。");
            $i = urlencode($login_id);
            $p = urlencode($pw);
        }
        header('Location: ../view/login.php?mes='.$mes.'&i='.$i.'&p='.$p);
        exit();
    }
    elseif ($login_id =="" && $pw =="") {
        $mes = urlencode("ID及びPWが未入力です。");
        $i = urlencode($login_id);
        $p = urlencode($pw);
        header('Location: ../view/login.php?mes='.$mes.'&i='.$i.'&p='.$p);
    }
    elseif ($login_id =="") {
        $mes = urlencode("IDが未入力です");
        $p = urlencode($pw);
        header('Location: ../view/login.php?mes='.$mes.'&p='.$p);
    }
    elseif ($pw =="") {
        $mes = urlencode("PWが未入力です。");
        $i = urlencode($login_id);
        header('Location: ../view/login.php?mes='.$mes.'&i='.$i);
    }
    else {
        echo "id No";
        $mes = urlencode("IDもしくはPWが正しくありません。");
        $i = urlencode($login_id);
        $p = urlencode($pw);
        header('Location: ../view/login.php?mes='.$mes.'&i='.$i.'&p='.$p);
    }
}

?>