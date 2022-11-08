<?php
    session_start();
    include('../model/threadCreate_model.php');

    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $contents = $_POST['contents'];
    $user_id = $_SESSION['login'];

    if(isset($_FILES['datafile'])){
        $datafile = $_FILES['datafile']['name'];
    }elseif($_SESSION['datafile']){
        $datafile = $_SESSION['datafile'];
    }else{
        $datafile = "";
    }

    // echo $_POST['category_id'];

    /* エラー分岐 */
    //カテゴリ未選択
    if($category_id == "カテゴリを選択"){
        $_SESSION['category_errmes'] = "選択が必須です。";
    }else{
        $_SESSION['category_errmes'] = "";
    }

    // タイトル文字数エラー
    if(mb_strlen($title) == ""){
        $_SESSION['title_errmes'] = "入力が必須です。";
    }else if(mb_strlen($title) >= 100){
        $_SESSION['title_errmes'] = "100文字以上入力されています。";
    }else{
        $_SESSION['title_errmes'] = "";
    }

    // 内容文字数エラー
    if(mb_strlen($contents) == ""){
        $_SESSION['contents_errmes'] = "入力が必須です。";
    }else if(mb_strlen($contents) >= 5000){
        $_SESSION['contents_errmes'] = "5000文字以上入力されています。";
    }else{
        $_SESSION['contents_errmes'] = "";
    }

    // 選択ファイルエラー
    if($datafile != ""){
        if(!preg_match('/\.(png|jpg|jpeg|mp4)$/i',$datafile)){
            $_SESSION['datafile_errmes'] = ".png/.jpg/.jpegファイルまたは.mp4ファイルを選択してください。";
        }elseif($_FILES['datafile']['error']==1){
            $_SESSION['datafile_errmes'] = "ファイルサイズが大きすぎます。";
        }else{
            $_SESSION['datafile_errmes'] = "";
        }
    }else{
        $_SESSION['datafile_errmes'] = "";
    }

    /* 遷移 */
    if($_SESSION['category_errmes']=="" && $_SESSION['title_errmes']=="" && $_SESSION['contents_errmes']=="" && $_SESSION['datafile_errmes']==""){
        echo "エラーなし";
        if($datafile != ""){
            $upload_file_path = '../view/image/'.$datafile;
            $result = move_uploaded_file($_FILES['datafile']['tmp_name'],$upload_file_path);
        }else{
            $upload_file_path = NULL;
        }
            echo $_FILES['datafile']['error'];
        //新規スレッド作成
        threadCreate($category_id,$title,$contents,$upload_file_path,$user_id);

        // セッション解除
        unset($_SESSION['category_errmes'],$_SESSION['title_errmes'],$_SESSION['contents_errmes'],
        $_SESSION['datafile_errmes'],$_SESSION['category_id'],$_SESSION['title'],
        $_SESSION['contents'],$_SESSION['upload_file_path']);

        // header('Location:../view/index.php');
        header('Location:../controller/index_controller.php');

    }else{
        $_SESSION['category_id'] = $category_id;
        $_SESSION['title'] = $title;
        $_SESSION['contents'] = $contents;
        $_SESSION['datafile'] = $datafile;
        if($datafile != ""){
            if($_FILES['datafile']['error']==1){
                $_SESSION['upload_file_path']="";
            }else{
                $upload_file_path = '../view/image/'.$datafile;
                $result = move_uploaded_file($_FILES['datafile']['tmp_name'],$upload_file_path);
                $_SESSION['upload_file_path'] = $upload_file_path;
                echo $_SESSION['upload_file_path'];
            }
        }else{
            $_SESSION['upload_file_path']="";
        }
        header('Location:../view/threadCreate.php');
    }

?>