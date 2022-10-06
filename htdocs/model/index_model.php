<?php
    include('../model/PDO_Connect.php');

    //必要なページ数を求める
    function count_page(){
        $dbh = connect();
        $count = $dbh->prepare('SELECT COUNT(*) AS count FROM thread');
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        $pages = ceil($total_count['count'] / max_view);
        return $pages;
    }
    //最近作成されたスレッド
    function newstmt($now){
        $dbh = connect();
        $newstmt = $dbh->prepare("select category_name,title,contents,handlename,datetime,(select count(*) from response where thread_id=thread.id) AS rescount
                                from thread 
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

    // レスの多い順
    function resstmt($now_res){
        $dbh = connect();
        $resstmt = $dbh->prepare("select category_name,title,contents,handlename,datetime,(select count(*) from response where thread_id=thread.id) AS rescount
                                from thread 
                                inner join users on thread.user_id=users.id 
                                inner join category on category.id=thread.category_id
                                ORDER BY rescount DESC
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
        $goodstmt = $dbh->prepare("select category_name,title,contents,handlename,datetime,(select count(*) from good where target_id=thread.id AND type=1) AS goodcount
                                from thread 
                                inner join users on thread.user_id=users.id 
                                inner join category on category.id=thread.category_id
                                ORDER BY goodcount DESC
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