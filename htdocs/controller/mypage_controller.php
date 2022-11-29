<?php

    session_start();

    include('../model/mypage_model.php');

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
    if(!isset($_GET['mypage_tab'])){
        $_GET['mypage_tab'] = "my_threadtab";
    }

    $id = $_SESSION['login'];

    $_SESSION['count_friends'] = count_friends($id);

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

    // 一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',10);

    // echo $_SESSION['my_page'];
    /* -----最近作成されたスレッド----- */
    // 必要なページ数を求める
    $_SESSION['my_page'] = ceil(count_page($id)['count'] / max_view);

    // 現在いるページのページ番号を取得
    if(!isset($_GET['mypage_id'])){ 
        $_SESSION['my_now'] = 1;
    }else{
        $_SESSION['my_now'] = $_GET['mypage_id'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    $_SESSION['my_newthread'] = newstmt($_SESSION['my_now'],$id);

    // print_r($_SESSION['my_newthread']);

    /* -----レス一覧----- */
    // 必要なページ数を求める
    $_SESSION['my_page_res'] = ceil(count_page_res($id)['count'] / max_view);

    // 現在いるページのページ番号を取得
    if(!isset($_GET['mypage_id_res'])){ 
        $_SESSION['my_now_res'] = 1;
    }else{
        $_SESSION['my_now_res'] = $_GET['mypage_id_res'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    $_SESSION['my_resthread'] = resstmt($_SESSION['my_now_res'],$id);

    /* -----いいね一覧----- */
    // 必要なページ数を求める
    $_SESSION['my_page_good'] = ceil(count_page_good($id)['count'] / max_view);

    // 現在いるページのページ番号を取得
    if(!isset($_GET['mypage_id_good'])){ 
        $_SESSION['my_now_good'] = 1;
    }else{
        $_SESSION['my_now_good'] = $_GET['mypage_id_good'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    $_SESSION['my_goodthread'] = goodstmt($_SESSION['my_now_good'],$id);

    //index.phpに戻る my_threadtab
    if($_GET['mypage_tab'] == 'my_threadtab'){
        if(isset($_GET['mypage_id'])){
            header("Location: ../view/mypage.php?mypage_tab=my_threadtab&mypage_id=".$_GET['mypage_id']);
            exit;
        }else{
            header("Location: ../view/mypage.php?mypage_tab=my_threadtab");
            exit;
        }
    }
    //index.phpに戻る my_responsetab
    if($_GET['mypage_tab'] == 'my_responsetab'){
        if(isset($_GET['mypage_id_res'])){
            header("Location: ../view/mypage.php?mypage_tab=my_responsetab&mypage_id_res=".$_GET['mypage_id_res']);
            exit;
        }else{
            header("Location: ../view/mypage.php?mypage_tab=my_responsetab");
            exit;
        }
    }
    //index.phpに戻る my_goodtab
    if($_GET['mypage_tab'] == 'my_goodtab'){
        if(isset($_GET['mypage_id_good'])){
            header("Location: ../view/mypage.php?mypage_tab=my_goodtab&mypage_id_res=".$_GET['mypage_id_good']);
            exit;
        }else{
            header("Location: ../view/mypage.php?mypage_tab=my_goodtab");
            exit;
        }
    }
?>