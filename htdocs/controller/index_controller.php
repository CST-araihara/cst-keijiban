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
    if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //カテゴリ選択無し
        $_SESSION['page'] = ceil(count_key_page($_GET['keyword'])['count'] / max_view);
    }else if(isset($_GET['category']) && isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード有
        $_SESSION['page'] = ceil(count_categorykey_page($_GET['category'],$_GET['keyword'])['count'] / max_view);
    }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード無
        $_SESSION['page'] = ceil(count_category_page($_GET['category'])['count'] / max_view);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'handlename'){ //
        $_SESSION['page'] = ceil(count_adminname_page($_POST['word'])['count'] / max_view);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'keyword'){ //
        $_SESSION['page'] = ceil(count_adminkey_page($_POST['word'])['count'] / max_view);
    }else{ //初期
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
    if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //カテゴリ選択無し
        $_SESSION['newthread'] = keynewstmt($_SESSION['now'],$_GET['keyword']);
    }else if(isset($_GET['category']) && isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード有
        $_SESSION['newthread'] = catekeynewstmt($_SESSION['now'],$_GET['category'],$_GET['keyword']);
    }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード無
        $_SESSION['newthread'] = categorynewstmt($_SESSION['now'],$_GET['category']);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'handlename'){ //
        $_SESSION['newthread'] = adminnamenewstmt($_SESSION['now'],$_SESSION['login'],$_POST['word']);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'keyword'){ //
        $_SESSION['newthread'] = adminkeynewstmt($_SESSION['now'],$_SESSION['login'],$_POST['word']);
    }else{ //初期
        $_SESSION['newthread'] = newstmt($_SESSION['now']);
    }

    /* -----レスの多い順----- */
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_res'])){ 
        $_SESSION['now_res'] = 1;
    }else{
        $_SESSION['now_res'] = $_GET['page_id_res'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //カテゴリ選択無し
        $_SESSION['resthread'] = keyresstmt($_SESSION['now_res'],$_GET['keyword']);
    }else if(isset($_GET['category']) && isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード有
        $_SESSION['resthread'] = catekeyresstmt( $_SESSION['now_res'],$_GET['category'],$_GET['keyword']);
    }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード無
        $_SESSION['resthread'] = categoryresstmt( $_SESSION['now_res'],$_GET['category']);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'handlename'){ //
        $_SESSION['resthread'] = adminnameresstmt($_SESSION['now_res'],$_SESSION['login'],$_POST['word']);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'keyword'){ //
        $_SESSION['resthread'] = adminkeyresstmt($_SESSION['now_res'],$_SESSION['login'],$_POST['word']);
    }else{ //初期
        $_SESSION['resthread'] = resstmt( $_SESSION['now_res']);
    }

    /* -----いいねの多い順-----*/
    // 現在いるページのページ番号を取得
    if(!isset($_GET['page_id_good'])){ 
        $_SESSION['now_good'] = 1;
    }else{
        $_SESSION['now_good'] = $_GET['page_id_good'];
    }

    // スレッド内容を表示させるデータをセッションに格納
    if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //カテゴリ選択無し
        $_SESSION['goodthread'] = keygoodstmt($_SESSION['now_good'],$_GET['keyword']);
    }else if(isset($_GET['category']) && isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード有
        $_SESSION['goodthread'] = catekeygoodstmt( $_SESSION['now_good'],$_GET['category'],$_GET['keyword']);
    }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ //カテゴリ選択無し以外キーワード無
        $_SESSION['goodthread'] = categorygoodstmt( $_SESSION['now_good'],$_GET['category']);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'handlename'){ //
        $_SESSION['goodthread'] = adminnamegoodstmt($_SESSION['now_good'],$_SESSION['login'],$_POST['word']);
    }else if(!isset($_GET['category']) && $_POST['terms1'] == 'keyword'){ //
        $_SESSION['goodthread'] = adminkeygoodstmt($_SESSION['now_good'],$_SESSION['login'],$_POST['word']);
    }else{
        $_SESSION['goodthread'] = goodstmt($_SESSION['now_good']);
    }

    // echo $_GET['keyword'].$_GET['category'];
    //index.phpに戻る・ページネーション検索分岐(最新)
    if($_GET['tab'] == 'new_threadtab'){
        if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //選択なし
            if(isset($_GET['keyword'])){
                if(isset($_GET['page_id'])){ //キーワード有、ページネーション有
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']."&keyword=".$_GET['keyword']."&page_id=".$_GET['page_id']);
                    exit;
                }else{ //キーワード有、ページネーション無
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']."&keyword=".$_GET['keyword']);
                    exit;
                }
            }else{
                if(isset($_GET['page_id'])){ //キーワード無、ページネーション有
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']."&page_id=".$_GET['page_id']);
                    exit;
                }else{ //キーワード無、ページネーション無
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']);
                    exit;
                }
            }
        }else if(isset($_GET['category'])){ //選択無し以外のカテゴリ
            if(isset($_GET['keyword'])){
                if(isset($_GET['page_id'])){ //キーワード有、ページネーション有
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']."&keyword=".$_GET['keyword']."&page_id=".$_GET['page_id']);
                    exit;
                }else{ //キーワード有、ページネーション無
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']."&keyword=".$_GET['keyword']);
                    exit;
                }
            }else{
                if(isset($_GET['page_id'])){ //キーワード無、ページネーション有
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']."&page_id=".$_GET['page_id']);
                    exit;
                }else{ //キーワード無、ページネーション無
                    header("Location:../view/index.php?tab=new_threadtab&category=".$_GET['category']);
                    exit;
                }
            }
        }else{ //カテゴリ選択無し（初期）
            if(isset($_GET['page_id']) && isset($_GET['keyword'])){ //ページネーション有かつキーワード有
                header("Location:../view/index.php?tab=new_threadtab&keyword=".$_GET['keyword']."&page_id=".$_GET['page_id']);
                exit;
            }else if(isset($_GET['page_id']) && !isset($_GET['keyword'])){ //ページネーション有かつキーワード無
                header("Location:../view/index.php?tab=new_threadtab&page_id=".$_GET['page_id']);
                exit;
            }else if(!isset($_GET['page_id']) && isset($_GET['keyword'])){ //ページネーション無かつキーワード有
                header("Location:../view/index.php?tab=new_threadtab&keyword=".$_GET['keyword']);
                exit;
            }else if(isset($_GET['page_id']) && $_POST['terms1']){ //ページネーション有かつ条件1有
                if ($_POST['terms1'] == 'handlename') {
                    $terms1 = 'ハンドルネーム';
                }
                elseif ($_POST['terms1'] == 'keyword') {
                    $terms1 = 'キーワード';
                }

                if ($_POST['terms2'] == 'thread') {
                    $terms2 = 'スレッド';
                }
                header("Location:../view/index.php?tab=new_threadtab&word=".$_POST['word']."&page_id=".$_GET['page_id']."&terms1=".$terms1."&terms2=".$terms2);
                exit;
            }else if(!isset($_GET['page_id']) && $_POST['terms1']){ //ページネーション無かつ条件1有
                if ($_POST['terms1'] == 'handlename') {
                    $terms1 = 'ハンドルネーム';
                }
                elseif ($_POST['terms1'] == 'keyword') {
                    $terms1 = 'キーワード';
                }

                if ($_POST['terms2'] == 'thread') {
                    $terms2 = 'スレッド';
                }
                header("Location:../view/index.php?tab=new_threadtab&word=".$_POST['word']."&terms1=".$terms1."&terms2=".$terms2);
                exit;
            }else{
                header("Location:../view/index.php?tab=new_threadtab");
                exit;
            }
        }
    }

        //index.phpに戻る・ページネーション検索分岐(レス)
    if($_GET['tab'] == 'many_responsetab'){
        if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //選択なし
            if(isset($_GET['keyword'])){
                if(isset($_GET['page_id_res'])){ //キーワード有、ページネーション有
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']."&keyword=".$_GET['keyword']."&page_id_res=".$_GET['page_id_res']);
                    exit;
                }else{ //キーワード有、ページネーション無
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']."&keyword=".$_GET['keyword']);
                    exit;
                }
            }else{
                if(isset($_GET['page_id_res'])){ //キーワード無、ページネーション有
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']."&page_id_res=".$_GET['page_id_res']);
                    exit;
                }else{ //キーワード無、ページネーション無
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']);
                    exit;
                }
            }
        }
        else if(isset($_GET['category'])){ //選択無し以外のカテゴリ
            if(isset($_GET['keyword'])){
                if(isset($_GET['page_id_res'])){ //キーワード有、ページネーション有
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']."&keyword=".$_GET['keyword']."&page_id_res=".$_GET['page_id_res']);
                    exit;
                }else{ //キーワード有、ページネーション無
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']."&keyword=".$_GET['keyword']);
                    exit;
                }
            }else{
                if(isset($_GET['page_id_res'])){ //キーワード無、ページネーション有
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']."&page_id_res=".$_GET['page_id_res']);
                    exit;
                }else{ //キーワード無、ページネーション無
                    header("Location:../view/index.php?tab=many_responsetab&category=".$_GET['category']);
                    exit;
                }
            }
        }else{ //カテゴリ選択無し（初期）
            if(isset($_GET['page_id_res']) && isset($_GET['keyword'])){ //ページネーション有かつキーワード有
                header("Location:../view/index.php?tab=many_responsetab&keyword=".$_GET['keyword']."&page_id_res=".$_GET['page_id_res']);
                exit;
            }else if(isset($_GET['page_id_res']) && !isset($_GET['keyword'])){ //ページネーション有かつキーワード無
                header("Location:../view/index.php?tab=many_responsetab&page_id_res=".$_GET['page_id_res']);
                exit;
            }else if(!isset($_GET['page_id_res']) && isset($_GET['keyword'])){ //ページネーション無かつキーワード有
                header("Location:../view/index.php?tab=many_responsetab&keyword=".$_GET['keyword']);
                exit;
            }else if(isset($_GET['page_id_res']) && $_POST['terms1']){ //ページネーション有かつ条件1有
                if ($_POST['terms1'] == 'handlename') {
                    $terms1 = 'ハンドルネーム';
                }
                elseif ($_POST['terms1'] == 'keyword') {
                    $terms1 = 'キーワード';
                }

                if ($_POST['terms2'] == 'thread') {
                    $terms2 = 'スレッド';
                }
                header("Location:../view/index.php?tab=many_responsetab&word=".$_POST['word']."&page_id_res=".$_GET['page_id_res']."&terms1=".$terms1."&terms2=".$terms2);
                exit;
            }else if(!isset($_GET['page_id_res']) && $_POST['terms1']){ //ページネーション無かつ条件1有
                if ($_POST['terms1'] == 'handlename') {
                    $terms1 = 'ハンドルネーム';
                }
                elseif ($_POST['terms1'] == 'keyword') {
                    $terms1 = 'キーワード';
                }

                if ($_POST['terms2'] == 'thread') {
                    $terms2 = 'スレッド';
                }
                header("Location:../view/index.php?tab=many_responsetab&word=".$_POST['word']."&terms1=".$terms1."&terms2=".$terms2);
                exit;
            }else{ //それ以外
                header("Location:../view/index.php?tab=many_responsetab");
                exit;
            }
        }
    }

    //index.phpに戻る・ページネーション検索分岐(いいね)
    if($_GET['tab'] == 'many_goodtab'){
        if(isset($_GET['category']) && $_GET['category']=="選択無し"){ //選択なし
            if(isset($_GET['keyword'])){
                if(isset($_GET['page_id'])){ //キーワード有、ページネーション有
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']."&keyword=".$_GET['keyword']."&page_id_good=".$_GET['page_id_good']);
                    exit;
                }else{ //キーワード有、ページネーション無
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']."&keyword=".$_GET['keyword']);
                    exit;
                }
            }else{
                if(isset($_GET['page_id'])){ //キーワード無、ページネーション有
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']."&page_id_good=".$_GET['page_id_good']);
                    exit;
                }else{ //キーワード無、ページネーション無
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']);
                    exit;
                }
            }
        }else if(isset($_GET['category'])){
            if(isset($_GET['keyword'])){
                    if(isset($_GET['page_id_good'])){
                        header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']."&keyword=".$_GET['keyword']."&page_id_good=".$_GET['page_id_good']);
                    exit;
                }else{
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']."&keyword=".$_GET['keyword']);
                    exit;
                }
            }else{
                if(isset($_GET['page_id_good'])){
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']."&page_id_good=".$_GET['page_id_good']);
                    exit;
                }else{
                    header("Location:../view/index.php?tab=many_goodtab&category=".$_GET['category']);
                    exit;
                }
            }
        }else{
            if(isset($_GET['page_id_good']) && isset($_GET['keyword'])){ //ページネーション有かつキーワード有
                header("Location:../view/index.php?tab=many_goodtab&keyword=".$_GET['keyword']."&page_id_good=".$_GET['page_id_good']);
                exit;
            }else if(isset($_GET['page_id_good']) && !isset($_GET['keyword'])){ //ページネーション有かつキーワード無
                header("Location:../view/index.php?tab=many_goodtab&page_id_good=".$_GET['page_id_good']);
                exit;
            }else if(!isset($_GET['page_id_good']) && isset($_GET['keyword'])){ //ページネーション無かつキーワード有
                header("Location:../view/index.php?tab=many_goodtab&keyword=".$_GET['keyword']);
                exit;
            }else if(isset($_GET['page_id_good']) && $_POST['terms1']){ //ページネーション有かつ条件1有
                if ($_POST['terms1'] == 'handlename') {
                    $terms1 = 'ハンドルネーム';
                }
                elseif ($_POST['terms1'] == 'keyword') {
                    $terms1 = 'キーワード';
                }

                if ($_POST['terms2'] == 'thread') {
                    $terms2 = 'スレッド';
                }
                header("Location:../view/index.php?tab=many_goodtab&word=".$_POST['word']."&page_id_res=".$_GET['page_id_good']."&terms1=".$terms1."&terms2=".$terms2);
                exit;
            }else if(!isset($_GET['page_id_good']) && $_POST['terms1']){ //ページネーション無かつ条件1有
                if ($_POST['terms1'] == 'handlename') {
                    $terms1 = 'ハンドルネーム';
                }
                elseif ($_POST['terms1'] == 'keyword') {
                    $terms1 = 'キーワード';
                }

                if ($_POST['terms2'] == 'thread') {
                    $terms2 = 'スレッド';
                }
                header("Location:../view/index.php?tab=many_goodtab&word=".$_POST['word']."&terms1=".$terms1."&terms2=".$terms2);
                exit;
            }else{
                header("Location:../view/index.php?tab=many_goodtab");
                exit;
            }
        }
    }

?>