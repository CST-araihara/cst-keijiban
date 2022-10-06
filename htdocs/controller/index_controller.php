<?php
    include('../model/index_model.php');

    // 一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',10);

    // 必要なページ数を求める
    $pages = count_page();

    // 最近作成されたスレッド
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id'])){ 
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    // 表示させるSQL文
    $newthread = newstmt($now);

    // レスの多い順
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_res'])){ 
        $now_res = 1;
    }else{
        $now_res = $_GET['page_id_res'];
    }
    // 表示させるSQL文
    $resthread = newstmt($now_res);

    // いいねの多い順
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_good'])){ 
        $now_good = 1;
    }else{
        $now_good = $_GET['page_id_good'];
    }
    // 表示させるSQL文
    $goodthread = goodstmt($now_good);

?>