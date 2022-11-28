<!-- headのタイトル -->
<?php $title = "研修掲示板レス投稿ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/response.css"; ?>
<?php 
    // if(!isset($_SESSION['res_thread'])){
    //     header("Location:../controller/response_controller.php?thread_id=".$_GET['thread_id']."");
    // }
?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
    // if(!isset($_SESSION['res_thread'])){
    //     header("Location:../controller/response_controller.php?thread_id=".$_GET['thread_id']."");
    // }

    $thread = $_SESSION['thread'];

    if(isset($_SESSION['res_contents_errmes'])){
        $contents_errmes = $_SESSION['res_contents_errmes'];
    }else{
        $contents_errmes = "";
    }

    if(isset($_SESSION['resfile_errmes'])){
        $imagefile_errmes = $_SESSION['resfile_errmes'];
    }else{
        $imagefile_errmes = "";
    }


    print_r($thread);
    echo $_SESSION['login'];
?>

<!-- テスト用セッション解除ボタン -->
<?php 
    if(isset($_POST['add'])){
        unset($_SESSION['res_contents_errmes'],$_SESSION['resfile_errmes'],
        $_SESSION['res_thread'],$_SESSION['upload_file_path']);
    }
?>

<main>
    <div class="response font-size--15">
        <!-- テスト用セッション解除ボタン -->
            <form action="#" method="post">
                <button type="submit" name="add">セッション解除</button>
            </form>
        <!-- テスト用セッション解除ボタン -->
        <div class="title-position">
            <div class="pagetitle">
                <h2 class="response-title english-font font-size--20">Response</h2>
            </div>
        </div>
        <!-- スレッド表示 -->
        <div class="thread">
            <div class="contents__main">
                <div class="contents__top">
                    <div class="contents__ribbon" 
                        style="background-color:<?php echo $thread['main_colorcode']; ?>;">
                        <div class="contents__ribbon-before" 
                            style="border-top: 3px solid <?php echo $thread['sub_colorcode']; ?>;
                                border-right: 3px solid  <?php  echo $thread['sub_colorcode']; ?>;">
                        </div>
                            <?php //カテゴリ
                                echo $thread['category_name'];
                            ?>
                        <div class="contents__ribbon-after" 
                            style="border-top: 10px solid <?php  echo $thread['main_colorcode']; ?>;
                                border-right: 10px solid transparent;
                                border-bottom: 10px solid <?php  echo $thread['main_colorcode']; ?>;
                                border-left: 0 solid <?php  echo $thread['main_colorcode'];?>;">
                        </div>
                    </div>
                    <p class="contents__title contents__char-center">
                        <?php //タイトル
                            echo $thread['title']; 
                        ?>
                    </p>
                </div>
                <div class="contents__middle">
                    <div class="contents__name">
                        <img class="contents__icon border_radius--small" src="<?php echo $thread['icon_img_path'] ?>" alt="">
                        <p class="contents__handlename">
                            <?php //ハンドルネーム
                                echo $thread['handlename']; 
                            ?>
                        </p>
                    </div>
                    <div class="contents__datetime">
                        <?php //投稿時間
                            echo $thread['datetime']; 
                        ?>
                    </div>
                </div>
                <div class="contents__bottom">
                    <div class="contents__detail contents__char-top">
                        <?php //スレッド内容
                            echo $thread['contents']; 
                        ?>
                    </div>
                    <!-- 画像または動画 -->
                    <?php if(isset($thread['upload_file_path'])){ ?>
                        <div class="contents__file_path">
                            <?php if(preg_match('/.mp4/',$thread['upload_file_path'])){ ?>
                                <video controls src="<?php echo $thread['upload_file_path']; ?>"></video>
                            <?php }else{ ?>
                                <img src="<?php echo $thread['upload_file_path']; ?>" alt="">
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- レス入力 -->
        <form class="response-form" action="../controller/response_controller.php" method="post" enctype="multipart/form-data">
            <div>
                <label class="hissu" for="">レス内容</label>
                <?php if($contents_errmes != ""){ ?>
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo $_SESSION['contents_errmes']; ?>
                    </div>
                <?php } ?>
                <textarea class="response-form__input" placeholder="内容を入力してください" name="contents" id="textarea" cols="30" rows="10"><?php if(isset($_SESSION['contents'])){echo $_SESSION['contents'];} ?></textarea>
                <!-- <div class="response-form__info"> -->
                    <!-- <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php //echo "文字数オーバーです"; ?></div> -->
                    <!-- <div class="count-text">
                        <div class="length">5000</div>
                        <p>/5000</p>
                    </div>
                </div> -->
                <div class="count-text">
                        <div class="length">5000</div>
                        <p>/5000</p>
                    </div>
            </div>
            <div>
                <div>
                    <label class="ninni" for="">写真・動画選択</label>
                    <!-- <input type="file" onChange="imgPreview(event)" accept=".jpg,.png,.jpeg,.mp4"> -->
                    <label class="icon__label border_radius--middle" for="icon-img">
                        <span class="">選択<i class="fa-solid fa-photo-film"></i></span>
                        <input type="file" id="icon-img" name="image" class="icon__input" accept=".png,.jpg,.jpeg,.mp4" onChange="imgPreview(event);">
                    </label>
                </div>
                <div id="preview">
                    <?php if(!empty($_SESSION['upload_file_path'])){
                        if(preg_match('/.mp4/',$_SESSION['upload_file_path'])){ ?>
                            <video controls src="<?php echo $thread['upload_file_path']; ?>"></video>
                        <?php }else{ ?>
                            <img src="<?php echo $_SESSION['upload_file_path']; ?>" alt="">
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <!-- <input type="hidden" name="hidden" value="1"> -->
            <div class="response__btn">
                <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
                <button class="btn btn--normal" type="submit" >送信する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/response.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>