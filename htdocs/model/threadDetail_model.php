<?php
    include('../model/PDO_Connect.php');

    function user(){
        $dbh = connect();
        $stmt = $dbh->prepare("SELECT *
                                FROM users;
                                ");
        $stmt->execute();
        $user = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $user;
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


    // スレッド詳細を表示
    function thread($id){
        $dbh = connect();
        $stmt = $dbh->prepare("SELECT thread.id
                                        ,category_name
                                        ,icon_img_path
                                        ,title
                                        ,contents
                                        ,upload_file_path
                                        ,handlename
                                        ,thread.user_id
                                        ,thread.delete_flag
                                        ,datetime
                                        ,(SELECT count(*)
                                            FROM response
                                            WHERE thread_id = thread.id)
                                        AS rescount
                                        ,main_colorcode
                                        ,sub_colorcode
                                FROM thread 
                                INNER JOIN users
                                ON thread.user_id = users.id
                                INNER JOIN category
                                ON category.id = thread.category_id
                                WHERE thread.id = '".$id."';
                                ");
        $stmt->execute();
        $thread = $stmt->fetch(PDO::FETCH_ASSOC);
        return $thread;
    }

    // 必要なページ数を求める
    function count_page($thread_id){
        $dbh = connect();
        $count = $dbh->prepare("SELECT COUNT(*) 
                                        AS count 
                                FROM response 
                                WHERE thread_id = '".$thread_id."'
                                AND delete_flag = 0;
                                ");
        $count->execute();
        $total_count = $count->fetch(PDO::FETCH_ASSOC);
        return $total_count;
    }

    // レス新しい順
    function newres($now,$thread_id){
        $dbh = connect();
        $stmt = $dbh->prepare("SELECT response.id
                                        ,handlename
                                        ,icon_img_path
                                        ,response.user_id
                                        ,datetime
                                        ,contents
                                        ,upload_file_path
                                        ,response.delete_flag
                                FROM response
                                INNER JOIN users
                                ON response.user_id = users.id
                                WHERE response.thread_id='".$thread_id."'
                                ORDER BY datetime DESC
                                LIMIT :start,:max;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $stmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $stmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $stmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $stmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $stmt->execute();
        $newres = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $newres;
    }

    // レス古い順
    function oldres($now,$thread_id){
        $dbh = connect();
        $stmt = $dbh->prepare("SELECT response.id
                                        ,handlename
                                        ,icon_img_path
                                        ,response.user_id
                                        ,datetime
                                        ,contents
                                        ,upload_file_path
                                        ,response.delete_flag
                                FROM response
                                INNER JOIN users
                                ON response.user_id = users.id
                                WHERE response.thread_id='".$thread_id."'
                                ORDER BY datetime ASC
                                LIMIT :start,:max;
                                ");
        if ($now == 1){
            //1ページ目の処理
            $stmt->bindValue(":start",$now -1,PDO::PARAM_INT);
            $stmt->bindValue(":max",max_view,PDO::PARAM_INT);
        } else {
            //1ページ目以外の処理
            $stmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
            $stmt->bindValue(":max",max_view,PDO::PARAM_INT);
        }
        //実行し結果を取り出しておく
        $stmt->execute();
        $oldres = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $oldres;
    }

?>