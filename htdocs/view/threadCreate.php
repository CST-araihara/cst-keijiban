<!-- headのタイトル -->
<?php $title = "研修掲示板スレッド作成ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/threadCreate.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<!-- テスト用セッション解除ボタン -->
<?php 
    // if(isset($_POST['add'])){
    //     unset($_SESSION['category_errmes'],$_SESSION['title_errmes'],$_SESSION['contents_errmes'],
    //         $_SESSION['datafile_errmes'],$_SESSION['category_id'],$_SESSION['title'],
    //         $_SESSION['contents'],$_SESSION['upload_file_path']);
    // } 
    // if(isset($_SESSION['category_id'])){
    //     echo $_SESSION['category_id'];
    // }
?>

<?php 
    if(isset($_SESSION['category_id'])){
        $category_id = $_SESSION['category_id'];
    }

    if(isset($_SESSION['category_errmes'])){
        $category_errmes = $_SESSION['category_errmes'];
    }else{
        $category_errmes = "";
    }

    if(isset($_SESSION['title_errmes'])){
        $title_errmes = $_SESSION['title_errmes'];
    }else{
        $title_errmes = "";
    }

    if(isset($_SESSION['contents_errmes'])){
        $contents_errmes = $_SESSION['contents_errmes'];
    }else{
        $contents_errmes = "";
    }

    if(isset($_SESSION['datafile_errmes'])){
        $datafile_errmes = $_SESSION['datafile_errmes'];
    }else{
        $datafile_errmes = "";
    }

    // echo $_SESSION['upload_file_path'];
?>

<main>
    <div class="threadCreate">
        <!-- テスト用セッション解除ボタン -->
        <!-- <form action="#" method="post">
            <button type="submit" name="add">セッション解除</button>
        </form> -->
        <!-- テスト用セッション解除ボタン -->
        <div class="title-position">
            <div class="pagetitle">
                <h2 class="Thread english-font font-size--20">Thread</h2>
            </div>
        </div>
        <form action="../controller/threadCreate_controller.php" class="create font-size--15" method="post" enctype="multipart/form-data">
            <div class="create__group">
                <label class="create__text hissu" for="">カテゴリ選択</label>
                <?php if($category_errmes != ""){ ?>
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo $_SESSION['category_errmes']; ?>
                    </div>
                <?php } ?>
                <div class="create__input">
                    <select class="create__input--select" name="category_id" id="">
                        <option hidden>カテゴリを選択</option>
                        <?php foreach ($category as $row){ 
                            if($row['id'] === $category_id){ ?>
                                <option value="<?php echo $row['id']; ?>" selected><?php echo $row['category_name']; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="create__group">
                <label class="create__text hissu" for="">タイトル</label>
                <?php if($title_errmes != ""){ ?>
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo $_SESSION['title_errmes']; ?>
                    </div>
                <?php } ?>
                <textarea class="create__input create__input--title" name="title" id="title"><?php if(isset($_SESSION['title'])){echo $_SESSION['title'];} ?></textarea>
                <div class="count-text">
                    <div class="title_length">100</div>
                    <p>/100</p>
                </div>
            </div>
            <div class="create__group">
                <label class="create__text hissu" for="">内容</label>
                <?php if($contents_errmes != ""){ ?>
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo $_SESSION['contents_errmes']; ?>
                    </div>
                <?php } ?>
                <textarea class="create__input create__input--contents" name="contents" id="contents"><?php if(isset($_SESSION['contents'])){echo $_SESSION['contents'];} ?></textarea>
                <div class="count-text ">
                    <div class="contents_length">5000</div>
                    <p>/5000</p>
                </div>
            </div>
            
            <div class="create__group">
                <label class="create__text ninni" for="">写真・動画選択</label>
                <div class="view_box">
                    <label for="filesend">
                        <span class="filelabel border_radius--middle">
                            選択
                            <i class="fa-solid fa-photo-film"></i>
                        </span>
                        <input type="file" class="file" name="datafile" id="filesend" accept=".jpg,.png,.jpeg,.mp4" >
                    </label>
                    <?php if(isset($_SESSION['upload_file_path'])&&$_SESSION['upload_file_path']!=""){
                        if(preg_match('/\.(mp4)$/i', $_SESSION['upload_file_path'])){
                            echo '<div class="preview_img"><video src="'.$_SESSION['upload_file_path'].'" height="100" class="img_view"></video><input class="img_del" type="reset" value="Reset"></div>'; 
                        }else{
                            echo '<div class="preview_img"><img src="'.$_SESSION['upload_file_path'].'" height="100" class="img_view"><input class="img_del" type="reset" value="Reset"></div>'; 
                        } 
                    }?>
                </div>

                <?php if($datafile_errmes != ""){ ?>
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo $_SESSION['datafile_errmes']; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="create__group--btn">
                <button class="btn btn--back" type="button" onclick="history.back();">前の画面に<br>戻る</button>
                <button class="btn btn--normal" type="submit">作成する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/threadCreate.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>