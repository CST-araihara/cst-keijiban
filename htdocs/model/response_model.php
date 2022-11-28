<?php
    include('../model/PDO_Connect.php');

    // スレッド表示
    // function res_thread($id){
    //     $dbh = connect();
    //     $stmt = $dbh->prepare("SELECT thread.id
    //                                     ,category_name
    //                                     ,icon_img_path
    //                                     ,title
    //                                     ,contents
    //                                     ,upload_file_path
    //                                     ,handlename
    //                                     ,thread.user_id
    //                                     ,thread.delete_flag
    //                                     ,datetime
    //                                     ,(SELECT count(*)
    //                                         FROM response
    //                                         WHERE thread_id = thread.id)
    //                                     AS rescount
    //                                     ,main_colorcode
    //                                     ,sub_colorcode
    //                             FROM thread 
    //                             INNER JOIN users
    //                             ON thread.user_id = users.id
    //                             INNER JOIN category
    //                             ON category.id = thread.category_id
    //                             WHERE thread.id = '".$id."';
    //                             ");
    //     $stmt->execute();
    //     $thread = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $thread;
    // }

    // テーブルに追加
    function responseCreate($thread_id,$contents,$upload_file_path,$user_id){
        $dbh = connect();
        $sth = $dbh->prepare("INSERT INTO response
                                        (thread_id
                                        ,contents
                                        ,upload_file_path
                                        ,user_id
                                        ,datetime
                                        ,delete_flag
                                        ,inserted_date)
                                        VALUES
                                        (:thread_id
                                        ,:contents
                                        ,:upload_file_path
                                        ,:user_id
                                        ,CURRENT_TIMESTAMP
                                        ,0
                                        ,CURRENT_TIMESTAMP);");
        $sth->bindValue(":thread_id",$thread_id);
        $sth->bindValue(":contents",$contents);
        $sth->bindValue(":upload_file_path",$upload_file_path);
        $sth->bindValue(":user_id",$user_id);
        $sth->execute();
    }

?>