<?php

session_start();

include('../model/profileEdit_model.php');

$id = $_SESSION['login'];
$handlename = $_POST['handlename'];
$password = $_POST['password'];
$password_check = $_POST['password_check'];
$filename = $_FILES['image']['name'];
$word = $_POST['word'];
$hidden = $_POST['hidden_img'];

if (isset($_POST['back'])) {
    unset($_SESSION['edit']);
    header("Location: ../view/mypage.php");
    exit;
}

// ハンドルネーム
if ($handlename =="") { // ハンドルネームが入力されていない
    $handle_mes = "入力は必須です";
}
elseif (mb_strlen($handlename) >= 20) {
    $handle_mes = "20文字以内で入力してください";
}
else { // OK
    $handle_mes = "";
}
$handle_char = $handlename;

// PW
if ($password =="") {  // PWが入力されていない
    $pass_mes = "入力は必須です";
}
elseif (!preg_match("/^([a-zA-Z0-9]{8,16})$/", $password)) { // PWが半角英数8~16文字でない
    $pass_mes = "半角英数8~16文字で入力してください";
    // $pass_char = $password;
}
else { // OK
    $pass_mes = "";
    // $pass_char = $password;
}
$pass_char = $password;

// PW確認
if ($password_check =="") { // PW確認が入力されていない
    $passcheck_mes = "入力は必須です";
}
elseif (!preg_match("/^([a-zA-Z0-9]{8,16})$/", $password_check)) { // PW確認が半角英数8~16文字でない
    $passcheck_mes = "半角英数8~16文字で入力してください";
    // $passcheck_char = $password_check;
}
elseif ($password_check != $password) { // PW確認がPWと一致しない
    $passcheck_mes = "パスワードが一致しません";
    // $passcheck_char = $password_check;
}
else { // OK
    $passcheck_mes = "";
}
$passcheck_char = $password_check;

// アイコンの拡張子
if ($filename =="" && $hidden =="") {
    $filename_mes = "";
    $filename = "f_f_event_3_s128_f_event_3_2bg.png";
    $uploaded_path = '../view/image/f_f_event_3_s128_f_event_3_2bg.png';
}
elseif ($filename =="" && $hidden !="") {
    $filename_mes = "";
    if (strpos($hidden, 'f_f_event_3_s128_f_event_3_2bg.png') !== false) {
        $filename = "f_f_event_3_s128_f_event_3_2bg.png";
        $uploaded_path = '../view/image/f_f_event_3_s128_f_event_3_2bg.png';
    }
    else {
        $filename = str_replace('../view/', '', $hidden);
        $uploaded_path = '../view/'.$filename;
    }
}
elseif ($filename =="") {
    $filename_mes = "";
    $filename = "f_f_event_3_s128_f_event_3_2bg.png";
    $uploaded_path = '../view/image/f_f_event_3_s128_f_event_3_2bg.png';
}
elseif (!preg_match('/\.(png|jpg|jpeg)$/i', $filename)) { // アイコンの拡張子が正しくない
    $filename_mes = " .png/.jpg/.jpegファイルのみです";
    $uploaded_path = '../view/image/f_f_event_3_s128_f_event_3_2bg.png';
}
else { // OK
    $filename_mes = "";
    $uploaded_path = '../view/image/'.$filename;
}
$result = move_uploaded_file($_FILES['image']['tmp_name'],$uploaded_path);

$filename_char = $uploaded_path;

// ひとこと
if (mb_strlen($word) >= 100) { // ひとことが100文字以内でない
    $word_mes = "100文字以内で入力してください";
}
else { // OK
    $word_mes = "";
}
$word_char = $word;

if ($handle_mes =="" && $pass_mes =="" && $passcheck_mes =="" && $filename_mes =="" && $word_mes =="") {
    $filename_char = str_replace('../view/', '', $filename_char);
    
    update($id, $handle_char, $pass_char, $word_char, $filename_char);

    $select_user = select_user($id);

    foreach($select_user as $row) {
        $_SESSION['handlename'] = $row['handlename'];
        $_SESSION['pw'] = $row['pw'];
        $_SESSION['icon'] = $row['icon_img_path'];
        $_SESSION['comment'] = $row['comment'];
    }
    unset($_SESSION['edit']);

    header('Location: ../view/mypage.php');
    exit;
}
else {
    $_SESSION['edit'] = [
        'handlename' => [$handle_mes,$handle_char],
        'pw' => [$pass_mes,$pass_char],
        'pw_check' => [$passcheck_mes,$passcheck_char],
        'filename' => [$filename_mes,$filename_char],
        'word' => [$word_mes,$word_char],
    ];
    
    header("Location: ../view/profileEdit.php");
    exit;
}

?>