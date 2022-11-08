<?php
    include('PDO_Connect.php');

    // テーブルに追加
    function threadCreate($category_id,$title,$contents,$upload_file_path,$user_id){
        $dbh = connect();
        $sth = $dbh->prepare("INSERT INTO thread 
                            (category_id,title,contents,upload_file_path,user_id,datetime,delete_flag,inserted_date)
                            VALUES(:category_id,:title,:contents,:upload_file_path,:user_id,CURRENT_TIMESTAMP,0,CURRENT_TIMESTAMP)");
        $sth->bindValue(":category_id",$category_id);
        $sth->bindValue(":title",$title);
        $sth->bindValue(":contents",$contents);
        $sth->bindValue(":upload_file_path",$upload_file_path);
        $sth->bindValue(":user_id",$user_id);
        $sth->execute();
    }
?>