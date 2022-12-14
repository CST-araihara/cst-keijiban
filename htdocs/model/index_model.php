<?php
    include('../model/PDO_Connect.php');

    //必要なページ数を求める
    function count_page(){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) 
                                AS count 
                                FROM thread;
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるkeyword
    function count_key_page($keyword){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count
                                FROM thread
                                WHERE title
                                LIKE '%".$keyword."%'
                                OR contents
                                LIKE '%".$keyword."%';
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるcategory
    function count_category_page($category){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count
                                FROM thread
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."';
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるcategorykeyword
    function count_categorykey_page($category,$keyword){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count
                                FROM thread
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."'
                                AND (title
                                    LIKE '%".$keyword."%'
                                    OR contents
                                    LIKE '%".$keyword."%');
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるadminname
    function count_adminname_page($handlename){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count
                                FROM thread
                                INNER JOIN users
                                ON users.id = thread.user_id
                                WHERE users.handlename
                                LIKE '%".$handlename."%';
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるadminkeyword
    function count_adminkey_page($keyword){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count
                                FROM thread
                                INNER JOIN users
                                ON users.id = thread.user_id
                                WHERE 
                                    title 
                                    LIKE '%".$keyword."%'
                                OR contents
                                    LIKE '%".$keyword."%'
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //最近作成されたスレッド
    function newstmt($now){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;
                                ");

        if ($now == 1){
            //1ページ目の処理
            $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $newstmt->execute();
        $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);
        return $newthread;
    }

    //最近作成されたスレッドkeyword
    function keynewstmt($now,$keyword){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,datetime
                                        ,thread.delete_flag
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE title
                                LIKE '%".$keyword."%'
                                OR contents
                                LIKE '%".$keyword."%'
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $newstmt->execute();
        $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);
        return $newthread;
    }

    //最近作成されたスレッドcategory
    function categorynewstmt($now,$category){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name='".$category."'
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $newstmt->execute();
        $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);
        return $newthread;
    }

    //最近作成されたスレッドcategorykeyword
    function catekeynewstmt($now,$category,$keyword){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."'
                                AND (title 
                                    LIKE '%".$keyword."%'
                                    OR contents
                                    LIKE '%".$keyword."%')
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $newstmt->execute();
        $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);
        return $newthread;
    }

    //最近作成されたスレッド(管理者)ハンドルネーム検索
    function adminnamenewstmt($now,$id,$handlename){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = thread.id
                                            AND type= 1
                                            AND user_id = $id) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE handlename
                                LIKE '%".$handlename."%'
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $newstmt->execute();
        $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);
        return $newthread;
    }

    //最近作成されたスレッド(管理者)キーワード検索
    function adminkeynewstmt($now,$id,$keyword){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = thread.id
                                            AND type= 1
                                            AND user_id = $id) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE 
                                    title 
                                    LIKE '%".$keyword."%'
                                OR contents
                                    LIKE '%".$keyword."%'
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $newstmt->execute();
        $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);
        return $newthread;
    }

    // レスの多い順
    function resstmt($now_res){
        $dbh = connect();
        $resstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_res == 1){
            //1ページ目の処理
            $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $resstmt->execute();
        $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);
        return $resthread;
    }

    // レスの多い順keyword
    function keyresstmt($now_res,$keyword){
        $dbh = connect();
        $resstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE title
                                LIKE '%".$keyword."%'
                                OR contents
                                LIKE '%".$keyword."%'
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_res == 1){
            //1ページ目の処理
            $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $resstmt->execute();
        $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);
        return $resthread;
    }

    // レスの多い順category
    function categoryresstmt($now_res,$category){
        $dbh = connect();
        $resstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."'
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_res == 1){
            //1ページ目の処理
            $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $resstmt->execute();
        $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);
        return $resthread;
    }

    // レスの多い順categorykeyword
    function catekeyresstmt($now_res,$category,$keyword){
        $dbh = connect();
        $resstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."'
                                AND (title
                                    LIKE '%".$keyword."%'
                                    OR contents
                                    LIKE '%".$keyword."%')
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_res == 1){
            //1ページ目の処理
            $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $resstmt->execute();
        $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);
        return $resthread;
    }

    // レスの多い順(管理者)ハンドルネーム検索
    function adminnameresstmt($now_res,$id,$handlename){
        $dbh = connect();
        $resstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,user_id
                                        ,handlename
                                        ,datetime
                                        ,thread.delete_flag
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = thread.id
                                            AND type= 1
                                            AND user_id = 1) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE handlename
                                LIKE '%".$handlename."%'
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_res == 1){
            //1ページ目の処理
            $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $resstmt->execute();
        $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);
        return $resthread;
    }

    // レスの多い順(管理者)キーワード検索
    function adminkeyresstmt($now_res,$id,$keyword){
        $dbh = connect();
        $resstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,user_id
                                        ,handlename
                                        ,datetime
                                        ,thread.delete_flag
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id
                                            AND delete_flag = 0)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = thread.id
                                            AND type= 1
                                            AND user_id = 1) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE 
                                    title 
                                    LIKE '%".$keyword."%'
                                OR contents
                                    LIKE '%".$keyword."%'
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_res == 1){
            //1ページ目の処理
            $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
            $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $resstmt->execute();
        $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);
        return $resthread;
    }

    // いいねの多い順
    function goodstmt($now_good){
        $dbh = connect();
        $goodstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM good
                                            WHERE target_id = thread.id 
                                            AND type=1)
                                        AS goodcount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_good == 1){
            //1ページ目の処理
            $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $goodstmt->execute();
        $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
        return $goodthread;
    }

    // いいねの多い順keyword
    function keygoodstmt($now_good,$keyword){
        $dbh = connect();
        $goodstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM good
                                            WHERE target_id = thread.id
                                            AND type=1)
                                        AS goodcount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE title
                                LIKE '%".$keyword."%'
                                OR contents
                                LIKE '%".$keyword."%'
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_good == 1){
            //1ページ目の処理
            $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $goodstmt->execute();
        $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
        return $goodthread;
    }
    
    // いいねの多い順category
    function categorygoodstmt($now_good,$category){
        $dbh = connect();
        $goodstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM good
                                            WHERE target_id = thread.id
                                            AND type=1)
                                        AS goodcount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users 
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."'
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_good == 1){
            //1ページ目の処理
            $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $goodstmt->execute();
        $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
        return $goodthread;
    }
    
    // いいねの多い順categprykeyword
    function catekeygoodstmt($now_good,$category,$keyword){
        $dbh = connect();
        $goodstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM good
                                            WHERE target_id = thread.id
                                            AND type = 1)
                                        AS goodcount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread
                                INNER JOIN users 
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE category_name = '".$category."'
                                AND (title 
                                    LIKE '%".$keyword."%'
                                    OR contents 
                                    LIKE '%".$keyword."%')
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_good == 1){
            //1ページ目の処理
            $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $goodstmt->execute();
        $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
        return $goodthread;
    }

    // いいねの多い順(管理者)handlename
    function adminnamegoodstmt($now_good,$id,$handlename){
        $dbh = connect();
        $goodstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM good
                                            WHERE target_id = thread.id 
                                            AND type=1)
                                        AS goodcount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = thread.id
                                            AND type= 2
                                            AND user_id = $id) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE handlename
                                LIKE '%".$handlename."%'
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_good == 1){
            //1ページ目の処理
            $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $goodstmt->execute();
        $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
        return $goodthread;
    }

    // いいねの多い順(管理者)keyword
    function adminkeygoodstmt($now_good,$id,$keyword){
        $dbh = connect();
        $goodstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM good
                                            WHERE target_id = thread.id 
                                            AND type=1)
                                        AS goodcount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = thread.id
                                            AND type= 2
                                            AND user_id = $id) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE 
                                    title 
                                    LIKE '%".$keyword."%'
                                OR contents
                                    LIKE '%".$keyword."%'
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;
                                ");
        if ($now_good == 1){
            //1ページ目の処理
            $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
            $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $goodstmt->execute();
        $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
        return $goodthread;
    }
?>