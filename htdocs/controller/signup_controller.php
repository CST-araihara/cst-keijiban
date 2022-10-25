<?php
session_start();

include('../model/signup_model.php');

$select = select();

$login_id = $_POST['login_id'];
$password = $_POST['password'];
$password_check = $_POST['password_check'];
$handlename = $_POST['handlename'];
$l_name = $_POST['l_name'];
$f_name = $_POST['f_name'];
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$filename = $_FILES['image']['name'];
$word = $_POST['word'];
$hidden = $_POST['hidden_img'];

// ログインID
if ($login_id =="") { // ログインIDが入力されていない
    $id_mes = "入力は必須です";
}
elseif (!preg_match("/^([a-zA-Z0-9]{0,10})$/", $login_id)) { // IDが半角英数10文字以内ではない
    $id_mes = "半角英数10文字以内で入力してください";
}
else {
    foreach($select as $row) {
        if ($login_id == $row['login_id']) { // ログインIDがすでに使用されているとき
            $id_mes = "IDは既に使用されています";
            break;
        }
        else { // OK
            $id_mes = "";
        }
    }
}
$id_char = $login_id;

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

// 氏
if ($l_name =="") { // 氏がない
    $l_name_mes = "入力は必須です";
}
else { // OK
    $l_name_mes = "";
}
$l_name_char = $l_name;

// 名
if ($f_name =="") { // 名がない
    $f_name_mes = "入力は必須です";
}
else { // OK
    $f_name_mes = "";
}
$f_name_char = $f_name;

// 生年月日
if ($year =="" || $month =="" || $day =="") { // 生年月日がない
    $dob_mes = "入力は必須です";
}
else { // OK
    $dob_mes = "";
}
$year_char = $year;
$month_char = $month;
$day_char = $day;

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
        $filename = str_replace('../view/image/tmp/', '', $hidden);
        $uploaded_path = '../view/image/tmp/'.$filename;
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
    $uploaded_path = '../view/image/tmp/'.$filename;
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

if ($id_mes =="" && $pass_mes =="" && $passcheck_mes =="" && $handle_mes =="" && $l_name_mes =="" && $f_name_mes =="" && $dob_mes =="" && $filename_mes =="" && $word_mes =="") {
    // 格納先フォルダを移動
    if (!isset($uploaded_path)) {
        $uploaded_path = '../view/image/tmp/'.$filename;
        $result = move_uploaded_file($_FILES['image']['tmp_name'],$uploaded_path);
    }

    charsets ($id_mes, $id_char, $pass_mes, $pass_char, $passcheck_mes, $passcheck_char, $handle_mes, $handle_char, $l_name_mes, $l_name_char, $f_name_mes, $f_name_char, $dob_mes, $year, $month, $day, $filename_mes, $filename_char, $word_mes, $word_char);

    header('Location: ../view/signupConfirm.php');
    exit;
}
else {
    charsets ($id_mes, $id_char, $pass_mes, $pass_char, $passcheck_mes, $passcheck_char, $handle_mes, $handle_char, $l_name_mes, $l_name_char, $f_name_mes, $f_name_char, $dob_mes, $year, $month, $day, $filename_mes, $filename_char, $word_mes, $word_char);

    header("Location: ../view/signup.php");
    exit;
}

// 連想配列にセットする
function charsets ($id_mes, $id_char, $pass_mes, $pass_char, $passcheck_mes, $passcheck_char, $handle_mes, $handle_char, $l_name_mes, $l_name_char, $f_name_mes, $f_name_char, $dob_mes, $year, $month, $day, $filename_mes, $filename_char, $word_mes, $word_char) {
    $_SESSION['signup'] = [
        'id' => [$id_mes, $id_char],
        'pw' => [$pass_mes,$pass_char],
        'pw_check' => [$passcheck_mes,$passcheck_char],
        'handlename' => [$handle_mes,$handle_char],
        'l_name' => [$l_name_mes,$l_name_char],
        'f_name' => [$f_name_mes,$f_name_char],
        'dob' => [$dob_mes,$year,$month,$day],
        'filename' => [$filename_mes,$filename_char],
        'word' => [$word_mes,$word_char],
    ];
}
?>