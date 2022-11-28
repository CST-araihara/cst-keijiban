<?php
    include('../model/response_model.php');
    session_start();

    $user_id = $_SESSION['login'];
    $thread_id = $_SESSION['thread']['id'];
    $contents = $_POST['contents'];

    if(isset($_FILES['image'])){
        $image_file = $_FILES['image'];
    }elseif(isset($_SESSION['image'])){
        $image_file = $_SESSION['image'];
    }else{
        $image_file = "";
    }
    print_r($image_file);
    
    //スレッド表示用
    // $_SESSION['thread'] = res_thread($_GET['thread_id']);

    if($contents == ""){
        $_SESSION['res_contents_errmes'] = "入力が必須です。";
    }else if(mb_strlen($contents) >= 5000){
        $_SESSION['res_contents_errmes'] = "5000文字以上入力されています。";
    }else{
        $_SESSION['res_contents_errmes'] = "";
    }

    // 選択ファイルエラー
    if($image_file != ""){
        if(!preg_match('/\.(png|jpg|jpeg|mp4)$/i',$image_file['name'])){
            $_SESSION['resfile_errmes'] = ".png/.jpg/.jpegファイルまたは.mp4ファイルを選択してください。";
        }elseif($_FILES['image']['error']==1){
            $_SESSION['resfile_errmes'] = "ファイルサイズが大きすぎます。";
        }else{
            $_SESSION['resfile_errmes'] = "";
        }
    }else{
        $_SESSION['resfile_errmes'] = "";
    }

    if($_SESSION['res_contents_errmes'] == "" && $_SESSION['resfile_errmes'] == ""){

        //▼todo:#39 写真画像、レス登録▼
        if($image_file != ""){
            $upload_file_path = '../view/image/'.$image_file;
            $result = move_uploaded_file($_FILE['image']['tmp_name'],$upload_file_path);
        }else{
            $upload_file_path = NULL;
        }
        responseCreate($thread_id,$contents,$upload_file_path,$user_id);
        //▲todo:#39 写真画像、レス登録▲

        // セッション削除
        unset($_SESSION['res_contents_errmes'],$_SESSION['resfile_errmes'],
        $_SESSION['res_thread'],$_SESSION['contents']);
        // スレッド詳細へ遷移
        // header("Location:../controller/threadDitail_controller.php");
        header("Location:../view/index.php");
        exit;
    }else{
        $_SESSION['contents'] = $contents;
        $_SESSION['image'] = $image_file;
        if($image_file != ""){
            if($_FILES['image']['error'] == 1){
                $_SESSION['upload_file_path'] = " ";
            }else{
                $upload_file_path = '../view/image/'.$image_file['name'];
                // $result = move_uploaded_file($_FILES['image']['tmp_name'],$upload_file_path);
                $_SESSION['upload_file_path'] = $upload_file_path;
            }
        }else{
            $_SESSION['upload_file_path'] = "";
        }
        header("Location:../view/response.php?thread_id=".$thread_id."");
        exit;
    }

    // if(!isset($_POST['hidden'])){
    //     header("Location:../view/response.php?thread_id=".$_GET['thread_id']."");
    //     exit;
    // }

?>