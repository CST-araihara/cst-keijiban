<!-- headのタイトル -->
<?php $title = "研修掲示板マイページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/mypage.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
        exit;
    }

    if(!isset($_SESSION['my_newthread'])){
        header("Location:../controller/mypage_controller.php");
    }

    $handlename = $_SESSION['handlename'];
    $login_id = $_SESSION['login_id'];
    $icon = $_SESSION['icon'];
    $comment = $_SESSION['comment'];
    $count = $_SESSION['count_friends'];

    foreach($count as $row) {
        $count = $row['COUNT(*)'];
    }

    $newthread = $_SESSION['my_newthread'];
    $resthread = $_SESSION['my_resthread'];
    $goodthread = $_SESSION['my_goodthread'];

    $pages = $_SESSION['my_page'];
    $pages_res = $_SESSION['my_page_res'];
    $pages_good = $_SESSION['my_page_good'];

    $now = $_SESSION['my_now'];
    $now_res = $_SESSION['my_now_res'];
    $now_good = $_SESSION['my_now_good'];

    // タブを押していないとき最近作成されたスレッドを表示させる
    if(!isset($_GET['mypage_tab'])){
        $_GET['mypage_tab'] = "my_threadtab";
    }
    // echo $pages;
    // print_r($resthread);

?>

<!-- テスト用セッション解除ボタン -->
<?php 
    // if(isset($_POST['add'])){
    //     unset($_SESSION['my_newthread']);
    // }
?>

<main>
        <!-- テスト用セッション解除ボタン -->
            <!-- <form action="#" method="post">
                <button type="submit" name="add">セッション解除</button>
            </form> -->
        <!-- テスト用セッション解除ボタン -->
    <div class="filter"></div>
    <div class="title-position">
        <div class="pagetitle">
            <h2 class="mypage english-font font-size--20">MyPage</h2>
        </div>
    </div>
    <div class="mypage-top">
        <div class="icon-position">
            <img class="icon border_radius--middle" src="<?php echo $icon; ?>" alt="">
        </div>
        <div class="name-position">
            <div class="name font-size--20">
                <div class="name__handlename"><p>HN</p>:<?php echo $handlename ?></div>
                <div class="name__id"><p>ID</p>:<?php echo $login_id; ?></div>
            </div>
            <div class="friends font-size--15">
                <!-- 友達の人数は計算して出す -->
                <a class="friends__people" href="../controller/friendslist_controller.php">友達:<?php echo $count; ?>人</a>
                <a class="friends__request" href="friendsrequestlist.php">友達リクエスト</a>
            </div>
        </div>
        <div class="comment-position">
            <div class="comment border_radius--middle font-size--15">
                <div class="comment__righttop english-font"><span>comment</span></div>
                <p class="comment__detail"><?php echo $comment; ?></p>
            </div>
        </div>
        <div class="btn-position">
            <button class="btn btn--normal" type="button"onclick="location.href='profileEdit.php'">プロフィールを編集する</button>
        </div>
    </div>
    <div class="mypage-bottom">
        <div class="tab font-size--15">
            <!-- inputのidとlabelのforが対になる -->
            <input class="target" id="my_threadtab" type="radio" name="tab_item" <?php if($_GET['mypage_tab']=="my_threadtab") echo 'checked'; ?>>
            <label class="tab_item" for="my_threadtab">最近作成したスレッド</label>
            <input class="target" id="my_responsetab" type="radio" name="tab_item" <?php if($_GET['mypage_tab']=="my_responsetab") echo 'checked'; ?>>
            <label class="tab_item" for="my_responsetab">最近のレス</label>
            <input class="target" id="my_goodtab" type="radio" name="tab_item" <?php if($_GET['mypage_tab']=="my_goodtab") echo 'checked'; ?>>
            <label class="tab_item" for="my_goodtab">いいね</label>
            <!-- idを任意のものに変える -->
            <div id="mythread_content" class="tab__switching">
                <ul>
                    <?php //スレッド表示
                        foreach($newthread as $newthre){
                            if($newthre['delete_flag'] == 0){ ?>
                                <li class="tab__contents">
                                    <div class="contents__main">
                                        <div class="contents__top">
                                            <div class="contents__ribbon"
                                                style="background-color:<?php echo $newthre['main_colorcode']; ?>;">
                                                <div class="contents__ribbon-before"
                                                    style="border-top:3px solid <?php echo $newthre['sub_colorcode']; ?>;
                                                        border-right:3px solid <?php echo $newthre['sub_colorcode']; ?>;">
                                                </div>
                                                <?php //カテゴリ
                                                    echo $newthre['category_name']; 
                                                ?>
                                                <div class="contents__ribbon-after"
                                                    style="border-top:10px solid <?php echo $newthre['main_colorcode']; ?>;
                                                        border-bottom:10px solid <?php echo $newthre['main_colorcode']; ?>;
                                                        border-left:0 solid <?php echo $newthre['main_colorcode']; ?>;">
                                                </div>
                                            </div>
                                            <p class="contents__title contents__char-center">
                                                <?php //最近作成されたタイトル
                                                    echo $newthre['title'];
                                                ?>
                                            </p>
                                            <div class="contents__datetime contents__char-center">
                                                <?php //時間 / レス数(XX)
                                                    echo $newthre['datetime']."/レス(".$newthre['rescount'].")";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="contents__bottom">
                                            <div class="contents__detail contents__char-top">
                                                <?php //スレッド内容
                                                    echo $newthre['contents'];
                                                ?>
                                            </div>
                                            <?php if(isset($newthre['upload_file_path'])){ ?>
                                                <div class="contents__imgicon">
                                                    <?php if(preg_match('/.mp4/',$newthre['upload_file_path'])){ ?>
                                                        <i class="fa-solid fa-film"></i>
                                                        <p>動画有</p>
                                                    <?php }else{ ?>
                                                        <i class="fa-regular fa-image"></i>
                                                        <p>写真有</p>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="contents__sub">
                                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                        <?php if(isset($_SESSION['login'])){ ?>
                                            <div class="contents__admin">
                                                <?php if($newthre['delete_flag'] == 0 && $_SESSION['login'] == $newthre['user_id']){ ?>
                                                    <div class="contents__delete">
                                                        <a href="../controller/mypage_controller.php?thread_id=<?php echo $newthre['id']; ?>&delete_flag=1" 
                                                            onclick="return confirm('選択したスレッドを削除しますか？')">
                                                            削除
                                                        </a>
                                                    </div>
                                                <?php }elseif($newthre['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                    <div class="contents__recover">
                                                        <a href="#">復元</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <!-- <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div> -->
                                        <div class="contents__good">いいね<i id="star" class="fa-regular fa-star"></i></div>
                                    </div>
                                </li>
                        <?php }
                            } 
                        ?>
                </ul>
                <!-- ページネーション -->
                <div class="page-btn">
                    <!-- 最初へボタン -->
                    <?php if($now >= 2){ ?>
                        <div class="page-btn--first enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_threadtab&mypage_id=1' class="page-text page-text--first enable-text">最初へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--first disable-color">
                            <span class="page-text page-text--first disable-text">最初へ</span>
                        </div>
                    <?php } ?>
                    <!-- 前へボタン -->
                    <?php if($now >= 2){ ?>
                        <div class="page-btn--previous border_radius--small enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_threadtab&mypage_id=<?php echo ($now - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                        </div>
                    <?php }else{?>
                        <div class="page-btn--previous border_radius--small disable-color">
                            <span class="page-text page-text--previous disable-text">前へ</span>
                        </div>
                    <?php } ?>
                    <!-- 次へボタン -->
                    <?php if($now < $pages){ ?>
                        <div class="page-btn--next border_radius--small enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_threadtab&mypage_id=<?php echo ($now + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                        </div>
                    <?php }else{?>
                        <div class="page-btn--next border_radius--small disable-color">
                            <span class="page-text page-text--next disable-text disable-text">次へ</span>
                        </div>
                    <?php } ?>
                    <!-- 最後へボタン -->
                    <?php if($now < $pages){ ?>
                        <div class="page-btn--last enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_threadtab&mypage_id=<?php echo $pages;?>' class="page-text page-text--last enable-text">最後へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--last disable-color">
                            <span class="page-text page-text--last disable-text">最後へ</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="pagecount"><?php echo $now ?>/<?php echo $pages ?>ページ</div>
            </div>

            <!-- idを任意のものに変える -->
            <div id="myresponse_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($resthread as $resthre){
                            if($resthre['res_delete_flag'] == 0 && $resthre['delete_flag'] == 0){ ?>
                                <li class="tab__contents">
                                    <div class="contents__main">
                                        <div class="contents__top">
                                            <div class="contents__ribbon"
                                                style="background-color:<?php echo $resthre['main_colorcode']; ?>;">
                                                <div class="contents__ribbon-before"
                                                    style="border-top:3px solid <?php echo $resthre['sub_colorcode']; ?>;
                                                        border-right:3px solid <?php echo $resthre['sub_colorcode']; ?>;">
                                                </div>
                                                <?php //カテゴリ
                                                    echo $resthre['category_name']; 
                                                ?>
                                                <div class="contents__ribbon-after"
                                                    style="border-top:10px solid <?php echo $resthre['main_colorcode']; ?>;
                                                        border-bottom:10px solid <?php echo $resthre['main_colorcode']; ?>;
                                                        border-left:0 solid <?php echo $resthre['main_colorcode']; ?>;">
                                                </div>
                                            </div>
                                            <p class="contents__title contents__char-center">
                                                <?php //タイトル
                                                    echo $resthre['title'];
                                                ?>
                                            </p>
                                            <div class="contents__datetime contents__char-center">
                                                <?php //スレッドの時間 / HN / レス数（XX）
                                                    echo $resthre['datetime']."/".$resthre['handlename']."/レス(".$resthre['rescount'].")";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="contents__bottom">
                                            <div class="contents__detail contents__char-top">
                                                <?php //スレッド内容
                                                    echo $resthre['contents'];
                                                ?>
                                            </div>
                                            <?php if(isset($resthre['upload_file_path'])){ ?>
                                                <div class="contents__imgicon">
                                                    <?php if(preg_match('/.mp4/',$resthre['upload_file_path'])){ ?>
                                                        <i class="fa-solid fa-film"></i>
                                                        <p>動画有</p>
                                                    <?php }else{ ?>
                                                        <i class="fa-regular fa-image"></i>
                                                        <p>写真有</p>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                    <div class="contents__response">
                                        <div class="contents__res">
                                            <div class="contents__char-top">
                                                <?php //レスの内容
                                                    echo $resthre['res_contents'];
                                                ?>
                                            </div>
                                            <?php if(isset($resthre['res_upload_file_path'])){ ?>
                                                <div class="contents__imgicon">
                                                    <?php if(preg_match('/.mp4/',$resthre['res_upload_file_path'])){ ?>
                                                        <i class="fa-solid fa-film"></i>
                                                        <p>動画有</p>
                                                    <?php }else{ ?>
                                                        <i class="fa-regular fa-image"></i>
                                                        <p>写真有</p>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="contents__resdatetime">
                                            <?php //レスの時間 
                                                    echo $resthre['res_datetime'];
                                                ?>
                                        </div>
                                    </div>
                                    <div class="contents__sub">
                                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                        <?php if(isset($_SESSION['login'])){ ?>
                                            <div class="contents__admin">
                                                <?php if($resthre['res_delete_flag'] == 0 && $_SESSION['login'] == $resthre['res_user_id']){ ?>
                                                    <div class="contents__delete">
                                                        <a href="../controller/mypage_controller.php?response_id=<?php echo $resthre['id']; ?>&delete_flag=2" 
                                                            onclick="return confirm('選択したレスを削除しますか？')">
                                                            削除
                                                        </a>
                                                    </div>
                                                <?php }elseif($resthre['res_delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                    <div class="contents__recover">
                                                        <a href="#">復元</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                                    </div>
                                </li>
                    <?php   }
                        }
                    ?>
                </ul>
                <!-- ページネーション -->
                <div class="page-btn">
                    <!-- 最初へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <div class="page-btn--first enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_responsetab&mypage_id_res=1' class="page-text page-text--first enable-text">最初へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--first disable-color">
                            <span class="page-text page-text--first disable-text">最初へ</span>
                        </div>
                    <?php } ?>
                    <!-- 前へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <div class="page-btn--previous border_radius--small enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_responsetab&mypage_id_res=<?php echo ($now_res - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                        </div>
                    <?php }else{?>
                        <div class="page-btn--previous border_radius--small disable-color">
                            <span class="page-text page-text--previous disable-text">前へ</span>
                        </div>
                    <?php } ?>
                    <!-- 次へボタン -->
                    <?php if($now_res < $pages_res){ ?>
                        <div class="page-btn--next border_radius--small enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_responsetab&mypage_id_res=<?php echo ($now_res + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                        </div>
                    <?php }else{?>
                        <div class="page-btn--next border_radius--small disable-color">
                            <span class="page-text page-text--next disable-text disable-text">次へ</span>
                        </div>
                    <?php } ?>
                    <!-- 最後へボタン -->
                    <?php if($now_res < $pages_res){ ?>
                        <div class="page-btn--last enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_responsetab&mypage_id_res=<?php echo $pages_res;?>' class="page-text page-text--last enable-text">最後へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--last disable-color">
                            <span class="page-text page-text--last disable-text">最後へ</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="pagecount"><?php echo $now_res ?>/<?php echo $pages_res ?>ページ</div>
            </div>
            
            <!-- idを任意のものに変える -->
            <div id="mygood_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($goodthread as $goodthre){
                            if($goodthre['delete_flag'] != 1 && ($goodthre['res_delete_flag'] == 0 && $goodthre['res_thread_delete_flag'] == 0)){ ?>
                                <li class="tab__contents">
                                    <div class="contents__main">
                                        <div class="contents__top">
                                            <?php if($goodthre['type'] == 1){ ?>
                                                <div class="contents__ribbon"
                                                    style="background-color:<?php echo $goodthre['main_colorcode']; ?>;">
                                                    <div class="contents__ribbon-before"
                                                        style="border-top:3px solid <?php echo $goodthre['sub_colorcode']; ?>;
                                                            border-right:3px solid <?php echo $goodthre['sub_colorcode']; ?>;">
                                                    </div>
                                                    <?php //カテゴリ
                                                        echo $goodthre['category_name']; 
                                                    ?>
                                                    <div class="contents__ribbon-after"
                                                        style="border-top:10px solid <?php echo $goodthre['main_colorcode']; ?>;
                                                            border-bottom:10px solid <?php echo $goodthre['main_colorcode']; ?>;
                                                            border-left:0 solid <?php echo $goodthre['main_colorcode']; ?>;">
                                                    </div>
                                                </div>
                                            <?php }elseif($goodthre['type'] == 2){ ?>
                                                <div class="contents__ribbon"
                                                    style="background-color:<?php echo $goodthre['res_main_colorcode']; ?>;">
                                                    <div class="contents__ribbon-before"
                                                        style="border-top:3px solid <?php echo $goodthre['res_sub_colorcode']; ?>;
                                                            border-right:3px solid <?php echo $goodthre['res_sub_colorcode']; ?>;">
                                                    </div>
                                                    <?php //カテゴリ
                                                        echo $goodthre['res_category_name']; 
                                                    ?>
                                                    <div class="contents__ribbon-after"
                                                        style="border-top:10px solid <?php echo $goodthre['res_main_colorcode']; ?>;
                                                            border-bottom:10px solid <?php echo $goodthre['res_main_colorcode']; ?>;
                                                            border-left:0 solid <?php echo $goodthre['res_main_colorcode']; ?>;">
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <p class="contents__title contents__char-center">
                                                <?php //タイトル
                                                    if($goodthre['type'] == 1){
                                                        echo $goodthre['title'];
                                                    }elseif($goodthre['type'] == 2){
                                                        echo $goodthre['res_thread_title'];
                                                    }
                                                ?>
                                            </p>
                                            <div class="contents__datetime contents__char-center">
                                                <?php //時間 / HN / レス数（XX）
                                                    if($goodthre['type'] == 1){
                                                        echo $goodthre['datetime']."/".$goodthre['handlename']."/レス(".$goodthre['rescount'].")";
                                                    }elseif($goodthre['type']=2){
                                                        echo $goodthre['res_thread_datetime']."/".$goodthre['res_thread_handlename']."/レス(".$goodthre['rescount'].")";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="contents__bottom">
                                            <div class="contents__detail contents__char-top">
                                                <?php //スレッド内容
                                                    if($goodthre['type'] == 1){
                                                        echo $goodthre['contents'];
                                                    }elseif($goodthre['type'] == 2){
                                                        echo $goodthre['res_thread_contents'];
                                                    }
                                                ?>
                                            </div>
                                            <?php if(isset($goodthre['upload_file_path'])||isset($goodthre['res_thread_upload_file_path'])){ ?>
                                                <div class="contents__imgicon">
                                                    <?php if(preg_match('/.mp4/',$goodthre['upload_file_path'])||preg_match('/.mp4/',$goodthre['res_thread_upload_file_path'])){ ?>
                                                        <i class="fa-solid fa-film"></i>
                                                        <p>動画有</p>
                                                    <?php }else{ ?>
                                                        <i class="fa-regular fa-image"></i>
                                                        <p>写真有</p>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- レスのいいね表示 -->
                                    <?php if($goodthre['type'] == 2){ ?>
                                        <div class="contents__response">
                                            <div class="contents__res">
                                                <div class=" contents__char-top">
                                                    <?php 
                                                        echo $goodthre['res_contents'];
                                                    ?>
                                                </div>
                                                
                                                <?php if(isset($goodthre['res_upload_file_path'])){ ?>
                                                    <div class="contents__imgicon">
                                                        <?php if(preg_match('/.mp4/',$goodthre['res_upload_file_path'])){ ?>
                                                            <i class="fa-solid fa-film"></i>
                                                            <p>動画有</p>
                                                        <?php }else{ ?>
                                                            <i class="fa-regular fa-image"></i>
                                                            <p>写真有</p>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="contents__resdatetime">
                                                <?php //レスの時間 
                                                    echo $goodthre['res_datetime']."/".$goodthre['res_handlename'];
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- 削除復元ボタン・スレッド -->
                                    <?php if($goodthre['type'] == 1){ ?>
                                        <div class="contents__sub">
                                            <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                            <?php if(isset($_SESSION['login'])){ ?>
                                                <div class="contents__admin">
                                                    <?php if($goodthre['delete_flag'] == 0 && $_SESSION['login'] == $goodthre['thread_user_id']){ ?>
                                                        <div class="contents__delete">
                                                            <a href="../controller/mypage_controller.php?thread_id=<?php echo $goodthre['id']; ?>&delete_flag=1" 
                                                                onclick="return confirm('選択したスレッドを削除しますか？')">
                                                                削除
                                                            </a>
                                                        </div>
                                                    <?php }elseif($goodthre['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                        <div class="contents__recover">
                                                            <a href="#">復元</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                                        </div>
                                    <!-- 削除復元ボタン・レス -->
                                    <?php }elseif($goodthre['type'] == 2){ ?>
                                        <div class="contents__sub">
                                            <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                            <?php if(isset($_SESSION['login'])){ ?>
                                                <div class="contents__admin">
                                                    <?php if($goodthre['res_delete_flag'] == 0 && $_SESSION['login'] == $goodthre['res_user_id']){ ?>
                                                        <div class="contents__delete">
                                                            <a href="../controller/mypage_controller.php?response_id=<?php echo $goodthre['res_id']; ?>&delete_flag=2" 
                                                                onclick="return confirm('選択したレスを削除しますか？')">
                                                                削除
                                                            </a>
                                                        </div>
                                                    <?php }elseif($goodthre['res_delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                        <div class="contents__recover">
                                                            <a href="#">復元</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                                        </div>
                                    <?php } ?>
                                </li>
                    <?php   }
                        } ?>
                </ul>
                <!-- ページネーション -->
                <div class="page-btn">
                    <!-- 最初へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <div class="page-btn--first enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_goodtab&mypage_id_good=1' class="page-text page-text--first enable-text">最初へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--first disable-color">
                            <span class="page-text page-text--first disable-text">最初へ</span>
                        </div>
                    <?php } ?>
                    <!-- 前へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <div class="page-btn--previous border_radius--small enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_goodtab&mypage_id_good=<?php echo ($now_good - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                        </div>
                    <?php }else{?>
                        <div class="page-btn--previous border_radius--small disable-color">
                            <span class="page-text page-text--previous disable-text">前へ</span>
                        </div>
                    <?php } ?>
                    <!-- 次へボタン -->
                    <?php if($now_good < $pages_good){ ?>
                        <div class="page-btn--next border_radius--small enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_goodtab&mypage_id_good=<?php echo ($now_good + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                        </div>
                    <?php }else{?>
                        <div class="page-btn--next border_radius--small disable-color">
                            <span class="page-text page-text--next disable-text disable-text">次へ</span>
                        </div>
                    <?php } ?>
                    <!-- 最後へボタン -->
                    <?php if($now_good < $pages_good){ ?>
                        <div class="page-btn--last enable-color">
                            <a href='../controller/mypage_controller.php?tab=my_responsetab&mypage_id_good=<?php echo $pages_good;?>' class="page-text page-text--last enable-text">最後へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--last disable-color">
                            <span class="page-text page-text--last disable-text">最後へ</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="pagecount"><?php echo $now_good ?>/<?php echo $pages_good ?>ページ</div>
            </div>
        </div>
    </div>
</main>

<!-- jsの適用 -->
<?php $js_url = "js/mypage.js"; ?>
<?php //$js_url = "js/good.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>