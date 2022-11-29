<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../view/index.php");
    exit();
}

include('../model/admin_model.php');

$category = category();
$_SESSION['category'] = $category;


if (isset($_POST['type'])) {
    if ($_POST['type'] == 'type1') {
        $type = 1;
    }
    elseif ($_POST['type'] == 'type2') {
        $type = 2;
    }

    $target_id = $_POST['target_id'];
    $user_id = $_SESSION['login'];

    $duplication = duplicationgood($type, $target_id, $user_id);

    if (!empty($duplication)) {
        removegood($type, $target_id, $user_id);
    }
    else {
        addgood($type, $target_id, $user_id);
    }
}

// tabに何も入っていないときnew_threadtabを入れる
if(!isset($_GET['adminpage_tab'])){
    $_GET['adminpage_tab'] = "admin_threadtab";
}

$id = $_SESSION['login'];

// GET送信で削除を受け取ったとき
if(isset($_GET['delete_flag'])){
    if($_GET['delete_flag'] == 1){ //スレッド
        thread_delete_flag($_GET['thread_id']);
        $_GET['delete_flag'] == '';
        // echo $_GET['thread_id'];
    }elseif($_GET['delete_flag'] == 2){ //レス
        response_delete_flag($_GET['response_id']);
        $_GET['delete_flag'] == '';
        // echo $_GET['response_id'];
    }
}
elseif(isset($_GET['recover_flag'])) { // GET送信で復元を受け取ったとき
    if($_GET['recover_flag'] == 1){ //スレッド
        thread_recover_flag($_GET['thread_id']);
        $_GET['recover_flag'] == '';
        // echo $_GET['thread_id'];
    }elseif($_GET['recover_flag'] == 2){ //レス
        response_recover_flag($_GET['response_id']);
        $_GET['recover_flag'] == '';
        // echo $_GET['response_id'];
    }
}

// 一ページに表示する記事の数をmax_viewに定数として定義
define('max_view',10);

/* -----最近作成されたスレッド----- */
// 必要なページ数を求める
$_SESSION['admin_page'] = ceil(count_page($id)['count'] / max_view);

// 現在いるページのページ番号を取得
if(!isset($_GET['adminpage_id'])){ 
    $_SESSION['admin_now'] = 1;
}else{
    $_SESSION['admin_now'] = $_GET['adminpage_id'];
}

// スレッド内容を表示させるデータをセッションに格納
$_SESSION['admin_newthread'] = newstmt($_SESSION['admin_now'],$id);

/* -----レス一覧----- */
// 必要なページ数を求める
$_SESSION['admin_page_res'] = ceil(count_page_res($id)['count'] / max_view);

// 現在いるページのページ番号を取得
if(!isset($_GET['adminpage_id_res'])){ 
    $_SESSION['admin_now_res'] = 1;
}else{
    $_SESSION['admin_now_res'] = $_GET['adminpage_id_res'];
}

// スレッド内容を表示させるデータをセッションに格納
$_SESSION['admin_resthread'] = resstmt($_SESSION['admin_now_res'],$id);

/* -----いいね一覧----- */
// 必要なページ数を求める
$_SESSION['admin_page_good'] = ceil(count_page_good($id)['count'] / max_view);

// 現在いるページのページ番号を取得
if(!isset($_GET['adminpage_id_good'])){ 
    $_SESSION['admin_now_good'] = 1;
}else{
    $_SESSION['admin_now_good'] = $_GET['adminpage_id_good'];
}

// スレッド内容を表示させるデータをセッションに格納
$_SESSION['admin_goodthread'] = goodstmt($_SESSION['admin_now_good'],$id);

//index.phpに戻る admin_threadtab
if($_GET['adminpage_tab'] == 'admin_threadtab'){
    if(isset($_GET['adminpage_id'])){
        header("Location: ../view/adminpage.php?adminpage_tab=admin_threadtab&adminpage_id=".$_GET['adminpage_id']);
        exit;
    }else{
        header("Location: ../view/adminpage.php?adminpage_tab=admin_threadtab");
        exit;
    }
}

//index.phpに戻る admin_responsetab
if($_GET['adminpage_tab'] == 'admin_responsetab'){
    if(isset($_GET['adminpage_id_res'])){
        header("Location: ../view/adminpage.php?adminpage_tab=admin_responsetab&adminpage_id_res=".$_GET['adminpage_id_res']);
        exit;
    }else{
        header("Location: ../view/adminpage.php?adminpage_tab=admin_responsetab");
        exit;
    }
}

//index.phpに戻る admin_goodtab
if($_GET['adminpage_tab'] == 'admin_goodtab'){
    if(isset($_GET['adminpage_id_good'])){
        header("Location: ../view/adminpage.php?adminpage_tab=admin_goodtab&adminpage_id_res=".$_GET['adminpage_id_good']);
        exit;
    }else{
        header("Location: ../view/adminpage.php?adminpage_tab=admin_goodtab");
        exit;
    }
}

// if (isset($_POST['type'])) {
//     echo 'type入ってるよ';
// }

// header('Location: ../view/adminpage.php');
// exit;

?>