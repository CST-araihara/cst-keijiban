<?php
    include('../model/index_model.php');
    session_start();

    // tabに何も入っていないときnew_threadtabを入れる
    if(!isset($_GET['tab'])){
        $_GET['tab'] = "new_threadtab";
    }

    // 一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',10);

    // 必要なページ数を求める
    if(isset($_GET['keyword'])){
        $_SESSION['page'] = ceil(count_key_page($_GET['keyword'])['count'] / max_view);
    }else{
        $_SESSION['page'] = ceil(count_page()['count'] / max_view);
    }

    /* -----最近作成されたスレッド----- */
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id'])){ 
        $_SESSION['now'] = 1;
    }else{
        $_SESSION['now'] = $_GET['page_id'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    if(isset($_GET['keyword'])){
        $_SESSION['newthread'] = keynewstmt($_SESSION['now'],$_GET['keyword']);
    }else{
        $_SESSION['newthread'] = newstmt($_SESSION['now']);
    }

    //index.phpに戻る・ページネーション検索分岐
    if($_GET['tab'] == 'new_threadtab'){
        if(isset($_GET['page_id']) && isset($_GET['keyword'])){ //ページネーション有かつキーワード有
            header("Location:../view/index.php?tab=new_threadtab&keyword=".$_GET['keyword']."&page_id=".$_GET['page_id']);
            exit;
        }else if(isset($_GET['page_id']) && !isset($_GET['keyword'])){ //ページネーション有かつキーワード無
            header("Location:../view/index.php?tab=new_threadtab&page_id=".$_GET['page_id']);
            exit;
        }else if(!isset($_GET['page_id']) && isset($_GET['keyword'])){ //ページネーション無かつキーワード有
            header("Location:../view/index.php?tab=new_threadtab&keyword=".$_GET['keyword']);
            exit;
        }else{
            header("Location:../view/index.php?tab=new_threadtab");
            exit;
        }
    }

    /* -----レスの多い順----- */
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_res'])){ 
        $_SESSION['now_res'] = 1;
    }else{
        $_SESSION['now_res'] = $_GET['page_id_res'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    if(isset($_GET['keyword'])){
        $_SESSION['resthread'] = keyresstmt( $_SESSION['now_res'],$_GET['keyword']);
    }else{
        $_SESSION['resthread'] = resstmt( $_SESSION['now_res']);
    }

      //index.phpに戻る・ページネーション検索分岐
    if($_GET['tab'] == 'many_responsetab'){
        if(isset($_GET['page_id_res']) && isset($_GET['keyword'])){ //ページネーション有かつキーワード有
            header("Location:../view/index.php?tab=many_responsetab&keyword=".$_GET['keyword']."&page_id_res=".$_GET['page_id_res']);
            exit;
        }else if(isset($_GET['page_id_res']) && !isset($_GET['keyword'])){ //ページネーション有かつキーワード無
            header("Location:../view/index.php?tab=many_responsetab&page_id_res=".$_GET['page_id_res']);
            exit;
        }else if(!isset($_GET['page_id_res']) && isset($_GET['keyword'])){ //ページネーション無かつキーワード有
            header("Location:../view/index.php?tab=many_responsetab&keyword=".$_GET['keyword']);
            exit;
        }else{
            header("Location:../view/index.php?tab=many_responsetab");
            exit;
        }
    }

    /* -----いいねの多い順-----*/
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_good'])){ 
        $_SESSION['now_good'] = 1;
    }else{
        $_SESSION['now_good'] = $_GET['page_id_good'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    if(isset($_GET['keyword'])){
        $_SESSION['goodthread'] = keygoodstmt( $_SESSION['now_good'],$_GET['keyword']);
    }else{
        $_SESSION['goodthread'] = goodstmt($_SESSION['now_good']);
    }

    //index.phpに戻る・ページネーション検索分岐
    if($_GET['tab'] == 'many_goodtab'){
        if(isset($_GET['page_id_good']) && isset($_GET['keyword'])){ //ページネーション有かつキーワード有
            header("Location:../view/index.php?tab=many_goodtab&keyword=".$_GET['keyword']."&page_id_good=".$_GET['page_id_good']);
            exit;
        }else if(isset($_GET['page_id_good']) && !isset($_GET['keyword'])){ //ページネーション有かつキーワード無
            header("Location:../view/index.php?tab=many_goodtab&page_id_good=".$_GET['page_id_good']);
            exit;
        }else if(!isset($_GET['page_id_good']) && isset($_GET['keyword'])){ //ページネーション無かつキーワード有
            header("Location:../view/index.php?tab=many_goodtab&keyword=".$_GET['keyword']);
            exit;
        }else{
            header("Location:../view/index.php?tab=many_goodtab");
            exit;
        }
    }

    // index.phpに戻る・ページネーションしていないとき
    // if(!isset($_GET['page_id']) && !isset($_GET['page_id_res']) && !isset($_GET['page_id_good'])){
    //     header("Location:../view/index.php");
    //     exit;
    // }

?>