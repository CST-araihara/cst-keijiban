<?php
// いらなくなったら消すファイル

// セッション開始
session_start();
// セッション変数を全て削除
$_SESSION = array();
// セッションの登録データを削除
session_destroy();
?>
<html>
    <p>ログアウト処理完了</p>
    <a href="login.php">ログイン画面</a>
</html>