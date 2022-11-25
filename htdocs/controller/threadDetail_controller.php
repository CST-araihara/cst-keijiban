<?php
    include('../model/threadDetail_model.php');
    session_start();

    // ユーザー情報をセッションに格納
    $_SESSION['friends'] = user();

    // タブを押していないとき最近作成されたスレッドを表示させる
    if(!isset($_GET['res_tab'])){
        $_GET['res_tab'] = "new_responsetab";
    }

     // GET送信で削除を受け取ったとき
    if(isset($_GET['delete_flag'])){
        if($_GET['delete_flag'] == 1){ //スレッド
            thread_delete_flag($_GET['thread_id']);
            $_GET['delete_flag'] == '';
            // echo $_GET['thread_id'];
            if($_SESSION['login'] != 1){
                header("Location:../controller/index_controller.php");
                exit;
            }
        }elseif($_GET['delete_flag'] == 2){ //レス
            response_delete_flag($_GET['response_id']);
            $_GET['delete_flag'] == '';
            // echo $_GET['response_id'];
        }
    }

    // 一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',10);

    $thread_id = $_GET['thread_id'];
    // echo $thread_id;

    // 選択したスレッドを表示させるデータをセッションに格納
    $_SESSION['thread'] = thread($thread_id);

    // print_r($_SESSION['thread']);

    /* レスの表示 */
    // 必要なページ数を求める
    $_SESSION['res_page'] = ceil(count_page($thread_id)['count'] / max_view);

    // 新しい順
    // 現在いるページのページ番号を取得
    if(!isset($_GET['newres_page_id'])){ 
        $_SESSION['newres_now'] = 1;
    }else{
        $_SESSION['newres_now'] = $_GET['newres_page_id'];
    }
    // print_r($_SESSION['newres_now']);

    // レスを表示させるデータをセッションに格納
    $_SESSION['new_response'] = newres($_SESSION['newres_now'],$thread_id);
    // print_r($_SESSION['new_response']);

    // 古い順
    // 現在いるページのページ番号を取得
    if(!isset($_GET['oldres_page_id'])){ 
        $_SESSION['oldres_now'] = 1;
    }else{
        $_SESSION['oldres_now'] = $_GET['oldres_page_id'];
    }
    // print_r($_SESSION['oldres_now']);
    //     echo $thread_id;

    // レスを表示させるデータをセッションに格納
    $_SESSION['old_response'] = oldres($_SESSION['oldres_now'],$thread_id);
    print_r($_SESSION['old_response']);

    // echo $_GET['res_tab'];

    if($_GET['res_tab'] == 'new_responsetab'){
        if(isset($_GET['newres_page_id'])){
            header("Location:../view/threadDetail.php?res_tab=new_responsetab&thread_id=".$thread_id."&newres_page_id=".$_GET['newres_page_id']);
            exit;
        }else{
            header("Location:../view/threadDetail.php?res_tab=new_responsetab&thread_id=".$thread_id);
            exit;
        }
    }

    if($_GET['res_tab'] == 'old_responsetab'){
        if(isset($_GET['oldres_page_id'])){
            header("Location:../view/threadDetail.php?res_tab=old_responsetab&thread_id=".$thread_id."&oldres_page_id=".$_GET['oldres_page_id']);
            exit;
        }else{
            header("Location:../view/threadDetail.php?res_tab=old_responsetab&thread_id=".$thread_id);
            exit;
        }
    }

?>