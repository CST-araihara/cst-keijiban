<?php
    include('PDO_Connect.php');

    function count_friends($id) {
        $dbh = connect();
        $sql = 'SELECT COUNT(*)
                FROM friend
                INNER JOIN users
                ON friend.your_user_id = users.id
                WHERE my_user_id = :id
                AND delete_flag = 0;';
        $sth = $dbh->prepare($sql);
        $sth->bindValue(':id',$id);
        $sth -> execute();

        $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
        return $aryList;
    }

    // スレッドを削除（delete_flag = 1 にする）updated_date = CURRENT_TIMESTAMP
    function thread_delete_flag($thread_id){
        $dbh = connect();
        $stmt = $dbh->prepare("UPDATE thread 
                                SET thread.delete_flag = 1
                                WHERE thread.id = '".$thread_id."';
                                ");
        $stmt->execute();
    }
    // レスを削除（delete_flag = 1 にする）
    function response_delete_flag($response_id){
        $dbh = connect();
        $stmt = $dbh->prepare("UPDATE response 
                                SET response.delete_flag = 1
                                WHERE response.id = '".$response_id."';
                                ");
        $stmt->execute();
    }

    //必要なページ数を求める my_threadtab
    function count_page($id){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) 
                                AS count 
                                FROM thread 
                                WHERE thread.user_id = '".$id."';
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求める my_responsetab
    function count_page_res($id){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) 
                                AS count 
                                FROM response
                                WHERE response.user_id = '".$id."';
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //必要なページ数を求める my_goodtab
    function count_page_good($id){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) 
                                AS count 
                                FROM good
                                WHERE good.user_id = '".$id."';
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    //スレッド
    function newstmt($now,$id){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.user_id
                                        ,datetime
                                        ,thread.delete_flag
                                        ,(SELECT count(*) 
                                            FROM response 
                                            WHERE thread_id = thread.id) 
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
                                WHERE thread.user_id = '".$id."'
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

    //レス
    function resstmt($now,$id){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT response.id
                                        ,category_name
                                        ,title
                                        ,thread.contents
                                        ,thread.upload_file_path
                                        ,handlename
                                        ,thread.user_id
                                        ,thread.datetime
                                        ,thread.delete_flag
                                        ,(SELECT count(*) 
                                            FROM response 
                                            WHERE thread_id = thread.id) 
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                        ,response.user_id
                                        AS res_user_id
                                        ,response.contents
                                        AS res_contents
                                        ,response.upload_file_path
                                        AS res_upload_file_path
                                        ,response.datetime
                                        AS res_datetime
                                        ,response.delete_flag
                                        AS res_delete_flag
                                        ,(SELECT id
                                            FROM good 
                                            WHERE target_id = response.id
                                            AND type= 2
                                            AND user_id = $id) 
                                        AS good_id
                                FROM thread
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                INNER JOIN response
                                ON response.thread_id = thread.id
                                WHERE response.user_id = '".$id."'
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

    //いいね
    function goodstmt($now,$id){
        $dbh = connect();
        $newstmt = $dbh->prepare("SELECT type
                                        ,target_id
                                        ,good.user_id
                                        ,good.inserted_date
                                        ,thread_1.id
                                        ,thread_2.id
                                        AS res_thread_id
                                        ,category_1.category_name
                                        ,category_2.category_name
                                        AS res_category_name
                                        ,thread_1.user_id
                                        AS thread_user_id
                                        ,thread_1.title
                                        ,thread_2.title
                                        AS res_thread_title
                                        ,thread_1.contents
                                        ,thread_2.contents
                                        AS res_thread_contents
                                        ,thread_1.upload_file_path
                                        ,thread_2.upload_file_path
                                        AS res_thread_upload_file_path
                                        ,users_1.handlename
                                        ,users_2.handlename
                                        AS res_thread_handlename
                                        ,thread_1.delete_flag
                                        ,thread_2.delete_flag
                                        AS res_thread_delete_flag
                                        ,(SELECT count(*) 
                                            FROM response 
                                            WHERE thread_id = thread_1.id
                                            OR thread_id = thread_2.id ) 
                                        AS rescount
                                        ,category_1.main_colorcode
                                        ,category_2.main_colorcode
                                        AS res_main_colorcode
                                        ,category_1.sub_colorcode
                                        ,category_2.sub_colorcode
                                        AS res_sub_colorcode
                                        ,thread_1.datetime
                                        ,thread_2.datetime
                                        AS res_thread_datetime
                                        ,response.id
                                        AS res_id
                                        ,response.user_id
                                        AS res_user_id
                                        ,users_res.handlename
                                        AS res_handlename
                                        ,response.contents 
                                        AS res_contents
                                        ,response.upload_file_path
                                        AS res_upload_file_path
                                        ,response.datetime
                                        AS res_datetime
                                        ,response.delete_flag
                                        AS res_delete_flag
                                        ,good.id
                                        AS good_id
                                FROM good
                                LEFT JOIN thread AS thread_1
                                ON good.target_id = thread_1.id AND type = 1
                                LEFT JOIN users AS users_1
                                ON users_1.id = thread_1.user_id AND type = 1
                                LEFT JOIN category AS category_1
                                ON category_1.id = thread_1.category_id AND type = 1
                                LEFT JOIN response
                                ON good.target_id = response.id AND type = 2
                                LEFT JOIN thread AS thread_2
                                ON thread_2.id = response.thread_id AND type = 2
                                LEFT JOIN category AS category_2
                                ON category_2.id = thread_2.category_id AND type = 2
                                LEFT JOIN users AS users_2
                                ON users_2.id = thread_2.user_id AND type = 2
                                LEFT JOIN users AS users_res
                                ON users_res.id = response.user_id AND type = 2
                                WHERE good.user_id = '".$id."'
                                ORDER BY good.inserted_date DESC;
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

// いいねの追加時重複回避
function duplicationgood($type, $target_id, $user_id) {
    $dbh = connect();
    $sql = 'SELECT
                *
            FROM
                good
            WHERE
                type = :type
            AND
                target_id = :target_id
            AND
                user_id = :user_id
            ;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':type',$type);
    $sth->bindValue(':target_id',$target_id);
    $sth->bindValue(':user_id',$user_id);
    $sth -> execute();

    $aryList = $sth -> fetchAll(PDO::FETCH_ASSOC);
    return $aryList;
}

// いいねを追加
function addgood($type, $target_id, $user_id) {
    $dbh = connect();
    $sql = 'INSERT INTO good
                (type
                ,target_id
                ,user_id
                ,inserted_date)
            VALUES
                (:type
                ,:target_id
                ,:user_id
                ,CURRENT_TIMESTAMP)
                ;
                ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':type',$type);
    $sth->bindValue(':target_id',$target_id);
    $sth->bindValue(':user_id',$user_id);
    $sth -> execute();
}

// いいねを削除
function removegood($type, $target_id, $user_id) {
    $dbh = connect();
    $sql = 'DELETE FROM
                good
            WHERE
                type = :type
            AND
                target_id = :target_id
            AND
                user_id = :user_id
            ;
            ';
    $sth = $dbh->prepare($sql);
    $sth->bindValue(':type',$type);
    $sth->bindValue(':target_id',$target_id);
    $sth->bindValue(':user_id',$user_id);
    $sth -> execute();
}

?>