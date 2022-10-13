<?php
    include('../model/index_model.php');
    session_start();

    // 一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',10);

    // 必要なページ数を求める
    $_SESSION['page'] = ceil(count_page()['count']/ max_view);

    // 最近作成されたスレッド
    // 現在いるページのページ番号を取得
    echo $_SESSION['now'];
    if(!isset($_GET['page_id'])){ 
        $_SESSION['now'] = 1;
    }else{
        $_SESSION['now'] = $_GET['page_id'];
    }

    // 表示させるSQL文
    $_SESSION['newthread'] = newstmt($_SESSION['now']);
    if(isset($_GET['page_id'])){
        header("Location:../view/index.php?tab=new_threadtab");
    }
    
    // レスの多い順
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_res'])){ 
        $_SESSION['now_res'] = 1;
    }else{
        $_SESSION['now_res'] = $_GET['page_id_res'];
    }

    // 表示させるSQL文
    $_SESSION['resthread'] = resstmt( $_SESSION['now_res']);
    if(isset($_GET['page_id_res'])){
        header("Location:../view/index.php?tab=many_responsetab");
    }

    // いいねの多い順
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_good'])){ 
        $_SESSION['now_good'] = 1;
    }else{
        $_SESSION['now_good'] = $_GET['page_id_good'];
    }

    // 表示させるSQL文
    $_SESSION['goodthread'] = goodstmt($_SESSION['now_good']);
    if(isset($_GET['page_id_good'])){
        header("Location:../view/index.php?tab=many_goodtab");
    }

    if(!isset($_GET['page_id']) && !isset($_GET['page_id_res']) && !isset($_GET['page_id_good'])){
        header("Location:../view/index.php");
    }

?>