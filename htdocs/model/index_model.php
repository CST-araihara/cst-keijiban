<?php
    include('../model/PDO_Connect.php');

    //必要なページ数を求める
    function count_page(){
        $dbh = connect();
        $count = $dbh->prepare('SELECT COUNT(*) AS count FROM thread');
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるkeyword
    function count_key_page($keyword){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count 
                                FROM thread 
                                WHERE title LIKE '%".$keyword."%' OR contents LIKE '%".$keyword."%'");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるcategory
    function count_category_page($category){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count 
                                FROM thread inner join category on category.id=thread.category_id 
                                WHERE category_name='".$category."'
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求めるcategorykeyword
    function count_categorykey_page($category,$keyword){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) AS count 
                                FROM thread inner join category on category.id=thread.category_id 
                                WHERE category_name='".$category."'
                                AND (title LIKE '%".$keyword."%' OR contents LIKE '%".$keyword."%');");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //最近作成されたスレッド
    function newstmt($now){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;"
                                );

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
        $newstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE title LIKE '%".$keyword."%'
                                OR contents LIKE '%".$keyword."%'
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $newstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE category_name='".$category."'
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $newstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE category_name='".$category."'
                                AND (title LIKE '%".$keyword."%'
                                OR contents LIKE '%".$keyword."%')
                                ORDER BY datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $resstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $resstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE title LIKE '%".$keyword."%'
                                OR contents LIKE '%".$keyword."%'
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $resstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE category_name='".$category."'
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $resstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM response WHERE thread_id=thread.id) AS rescount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE category_name='".$category."'
                                AND (title LIKE '%".$keyword."%'
                                OR contents LIKE '%".$keyword."%')
                                ORDER BY rescount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $goodstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM good WHERE target_id=thread.id AND type=1) AS goodcount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $goodstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM good WHERE target_id=thread.id AND type=1) AS goodcount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE title LIKE '%".$keyword."%'
                                OR contents LIKE '%".$keyword."%'
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $goodstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM good WHERE target_id=thread.id AND type=1) AS goodcount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE category_name='".$category."'
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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
        $goodstmt = $dbh->prepare("SELECT category_name,title,contents,upload_file_path,handlename,datetime,(SELECT count(*) FROM good WHERE target_id=thread.id AND type=1) AS goodcount
                                FROM thread
                                inner join users on thread.user_id=users.id
                                inner join category on category.id=thread.category_id
                                WHERE category_name='".$category."'
                                AND (title LIKE '%".$keyword."%'
                                OR contents LIKE '%".$keyword."%')
                                ORDER BY goodcount DESC , datetime DESC
                                LIMIT :start,:max ;"
                                );
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