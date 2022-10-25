<?php
session_start();

include('../model/signupConfirm_model.php');

// 1～9月を2桁表記 ex)01
if ($_SESSION['signup']['dob'][2] <10) {
    $month = "0".$_SESSION['signup']['dob'][2];
}
else {
    $month = $_SESSION['signup']['dob'][2];
}

// 1～9日を2桁表記
if ($_SESSION['signup']['dob'][3] <10) {
    $day = "0".$_SESSION['signup']['dob'][3];
}
else {
    $day = $_SESSION['signup']['dob'][3];
}

if (strpos($_SESSION['signup']['filename'][1],'f_f_event_3_s128_f_event_3_2bg.png') !== false) {
    $move_path = $_SESSION['signup']['filename'][1];
}
else {
    // パスの../view/image/tmp/を削除し、移動先のパスに変更
    $img_tmp_path = str_replace('../view/image/tmp/', '', $_SESSION['signup']['filename'][1]);
    $move_path = "../view/image/".$img_tmp_path;

    // アイコン画像をtmpフォルダから1階層上（image）に移動
    rename($_SESSION['signup']['filename'][1], $move_path);
}
$path = str_replace('../view/', '', $move_path);

$login_id = $_SESSION['signup']['id'][1];
$handlename = $_SESSION['signup']['handlename'][1];
$last_name = $_SESSION['signup']['l_name'][1];
$first_name = $_SESSION['signup']['f_name'][1];
$pw = $_SESSION['signup']['pw'][1];
$dob = $_SESSION['signup']['dob'][1]."-".$month."-".$day;
$comment = $_SESSION['signup']['word'][1];
$icon_img_path = $path;

insert($login_id, $handlename, $last_name, $first_name, $pw, $dob, $comment, $icon_img_path);

unset($_SESSION['signup']);

// IDが最大値のユーザー＝新規登録したユーザー
$new_user = select_newuser();

foreach ($new_user as $row) {
    $_SESSION['login'] = $row['id'];
    $_SESSION['login_id'] = $row['login_id'];
    $_SESSION['handlename'] = $row['handlename'];
    $_SESSION['icon'] = $row['icon_img_path'];
    $_SESSION['comment'] = $row['comment'];
    $_SESSION['role'] = $row['role'];
}

header("Location: ../view/mypage.php");
exit;

?>