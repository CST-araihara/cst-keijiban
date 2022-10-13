<!-- ログアウト処理用controller-->

<?php
// セッション開始
session_start();
// セッション変数を全て削除
$_SESSION = array();
// セッションの登録データを削除
session_destroy();

$alert = "<script>alert('ログアウトしました。');</script>";
echo $alert;

echo '<script>location.href = "../view/index.php" ;</script>';
?>