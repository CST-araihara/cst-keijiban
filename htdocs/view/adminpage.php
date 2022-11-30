<!-- headのタイトル -->
<?php $title = "研修掲示板管理者画面"; ?>
<!-- cssの適用 -->
<?php $url = "scss/adminpage.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if ($_SESSION['role'] != 1) {
    header("Location: index.php");
    exit;
}

if(!isset($_SESSION['admin_newthread'])){
    header("Location:../controller/adminpage_controller.php");
}

$category = $_SESSION['category'];
$icon = $_SESSION['icon'];

$newthread = $_SESSION['admin_newthread'];
$resthread = $_SESSION['admin_resthread'];
$goodthread = $_SESSION['admin_goodthread'];

$pages = $_SESSION['admin_page'];
$pages_res = $_SESSION['admin_page_res'];
$pages_good = $_SESSION['admin_page_good'];

$now = $_SESSION['admin_now'];
$now_res = $_SESSION['admin_now_res'];
$now_good = $_SESSION['admin_now_good'];

// タブを押していないとき最近作成されたスレッドを表示させる
if(!isset($_GET['adminpage_tab'])){
    $_GET['adminpage_tab'] = "admin_threadtab";
}
?>

<main>
    <div class="title-position">
        <div class="pagetitle">
            <h2 class="admin english-font font-size--20">AdminPage</h2>
        </div>
    </div>
    <div class="search-position font-size--15">
        <form class="search" action="../controller/index_controller.php" method="post">
            <input name="word" class="search__box" type="text" placeholder="検索ワード">
            <button class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <div class="search__condition">
                <div class="conditions">
                    <div>
                        <input name="terms1" id="user_check" value="handlename" type="radio" checked><label class="space" for="user_check">ハンドルネーム</label>
                    </div>
                    <div>
                        <input name="terms1" id="keyword_check" value="keyword" type="radio"><label class="space" for="keyword_check">キーワード</label>
                    </div>
                    <div>
                        <input name="terms1" id="user_key_check" value="name_keyword" type="radio"><label class="space" for="user_key_check">ハンドルネームとキーワード</label>
                    </div>
                </div>
                <div class="char-center">で</div>
                <div class="conditions">
                    <div>
                        <input name="terms2" id="thread_check" value="thread" type="radio" checked><label for="thread_check">スレッド</label>
                    </div>
                    <div>
                        <input name="terms2" id="res_check" value="response" type="radio"><label for="res_check">レス</label>
                    </div>
                    <div>
                        <input name="terms2" id="thread_res_check" value="thread_res" type="radio"><label for="thread_res_check">スレッドとレス</label>
                    </div>
                </div>
                <div class="char-center">を検索する</div>
            </div>
        </form>
    </div>
    <div class="page-all font-size--15">
        <div class="page-top">
            <div class="icon-name-position">
                <div class="icon-position">
                    <img class="icon border_radius--middle" src="<?php echo $icon ?>" alt="">
                </div>
                <div class="name-position">
                    <div class="name font-size--20">
                        <div class="name__handlename"><p>HN</p>:管理者</div>
                        <div class="name__id"><p>ID</p>:admin0000</div>
                    </div>
                </div>
            </div>
            <div class="btn-position">
                <button class="btn btn--normal" type="button" onclick="location.href='../controller/userslist_controller.php'">ユーザー一覧</button>
                <button class="btn btn--normal" type="button" onclick="location.href='../controller/accesshistorylist_controller.php'">アクセス履歴</button>
            </div>
        </div>
        <div class="page-middle">
            <div class="category-position">
                <?php
                foreach($category as $row) {
                ?>
                <li><button class="btn btn--normal" type="button" onclick="location.href='../controller/index_controller.php?category=<?php echo $row['category_name']; ?>'"><?php echo $row['category_name']; ?></button></li>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="adminpage-bottom">
        <div class="tab font-size--15">
            <!-- inputのidとlabelのforが対になる -->
            <input class="target" id="admin_threadtab" type="radio" name="tab_item" <?php if($_GET['adminpage_tab']=="admin_threadtab") echo 'checked'; ?>>
            <label class="tab_item" for="admin_threadtab">最近作成したスレッド</label>
            <input class="target" id="admin_responsetab" type="radio" name="tab_item" <?php if($_GET['adminpage_tab']=="admin_responsetab") echo 'checked'; ?>>
            <label class="tab_item" for="admin_responsetab">最近のレス</label>
            <input class="target" id="admin_goodtab" type="radio" name="tab_item" <?php if($_GET['adminpage_tab']=="admin_goodtab") echo 'checked'; ?>>
            <label class="tab_item" for="admin_goodtab">いいね</label>
            <!-- idを任意のものに変える -->
            <div id="adminthread_content" class="tab__switching">
                <ul>
                    <?php //スレッド表示
                        foreach($newthread as $newthre){
                            if($newthre['delete_flag'] == 0 || $_SESSION['login'] == 1){ ?>
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
                                                        <a class="jump" href="../controller/adminpage_controller.php?thread_id=<?php echo $newthre['id']; ?>&delete_flag=1" 
                                                            onclick="return confirm('選択したスレッドを削除しますか？')">
                                                            削除
                                                        </a>
                                                    </div>
                                                <?php }elseif($newthre['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                    <div class="contents__recover">
                                                        <a class="jump" href="../controller/adminpage_controller.php?thread_id=<?php echo $newthre['id']; ?>&recover_flag=1">復元</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <div>
                                        <?php
                                        }
                                        if (isset($newthre['good_id'])) {
                                        ?>
                                            <div class="contents__good">いいね<i class="fa-regular fa-star goldstar"></i></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <div class="contents__good">いいね<i class="fa-regular fa-star whitestar"></i></div>
                                        <?php
                                        }
                                        ?>
                                            <input type="hidden" value="type1">
                                            <input type="hidden" value="<?php echo $newthre['good_id']; ?>">
                                            <input type="hidden" value="<?php echo $newthre['id']; ?>">
                                        </div>
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
                            <a href='../controller/adminpage_controller.php?tab=admin_threadtab&adminpage_id=1' class="page-text page-text--first enable-text">最初へ</a>
                        </div>
                        <?php }else{ ?>
                        <div class="page-btn--first disable-color">
                            <span class="page-text page-text--first disable-text">最初へ</span>
                        </div>
                        <?php } ?>
                    <!-- 前へボタン -->
                    <?php if($now >= 2){ ?>
                        <div class="page-btn--previous border_radius--small enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_threadtab&adminpage_id=<?php echo ($now - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                        </div>
                        <?php }else{?>
                        <div class="page-btn--previous border_radius--small disable-color">
                            <span class="page-text page-text--previous disable-text">前へ</span>
                        </div>
                        <?php } ?>
                    <!-- 次へボタン -->
                    <?php if($now < $pages){ ?>
                        <div class="page-btn--next border_radius--small enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_threadtab&adminpage_id=<?php echo ($now + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                        </div>
                        <?php }else{?>
                        <div class="page-btn--next border_radius--small disable-color">
                            <span class="page-text page-text--next disable-text disable-text">次へ</span>
                        </div>
                        <?php } ?>
                    <!-- 最後へボタン -->
                    <?php if($now < $pages){ ?>
                        <div class="page-btn--last enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_threadtab&adminpage_id=<?php echo $pages;?>' class="page-text page-text--last enable-text">最後へ</a>
                        </div>
                        <?php }else{ ?>
                        <div class="page-btn--last disable-color">
                            <span class="page-text page-text--last disable-text">最後へ</span>
                        </div>
                        <?php } ?>
                </div>
                <div class="pagecount"><?php echo $now ?>/<?php echo $pages ?>ページ</div>
            </div>
            <div id="adminresponse_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($resthread as $resthre){
                            if(($resthre['res_delete_flag'] == 0 && $resthre['delete_flag'] == 0) || $_SESSION['login'] == 1){ ?>
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
                                                        <a class="jump" href="../controller/adminpage_controller.php?response_id=<?php echo $resthre['id']; ?>&delete_flag=2" 
                                                            onclick="return confirm('選択したレスを削除しますか？')">
                                                            削除
                                                        </a>
                                                    </div>
                                                <?php }elseif($resthre['res_delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                    <div class="contents__recover">
                                                        <a class="jump" href="../controller/adminpage_controller.php?response_id=<?php echo $resthre['id']; ?>&recover_flag=2">復元</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <div>
                                        <?php
                                        }
                                        if (isset($resthre['good_id'])) {
                                        ?>
                                            <div class="contents__good">いいね<i class="fa-regular fa-star goldstar"></i></div>
                                        <?php
                                        }
                                        else {
                                        ?>
                                            <div class="contents__good">いいね<i class="fa-regular fa-star whitestar"></i></div>
                                        <?php
                                        }
                                        ?>
                                            <input type="hidden" value="type2">
                                            <input type="hidden" value="<?php echo $resthre['good_id']; ?>">
                                            <input type="hidden" value="<?php echo $resthre['id']; ?>">
                                        </div>
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
                            <a href='../controller/adminpage_controller.php?tab=admin_responsetab&adminpage_id_res=1' class="page-text page-text--first enable-text">最初へ</a>
                        </div>
                        <?php }else{ ?>
                        <div class="page-btn--first disable-color">
                            <span class="page-text page-text--first disable-text">最初へ</span>
                        </div>
                        <?php } ?>
                    <!-- 前へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <div class="page-btn--previous border_radius--small enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_responsetab&adminpage_id_res=<?php echo ($now_res - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                        </div>
                        <?php }else{?>
                        <div class="page-btn--previous border_radius--small disable-color">
                            <span class="page-text page-text--previous disable-text">前へ</span>
                        </div>
                    <?php } ?>
                    <!-- 次へボタン -->
                    <?php if($now_res < $pages_res){ ?>
                        <div class="page-btn--next border_radius--small enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_responsetab&adminpage_id_res=<?php echo ($now_res + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                            <?php }else{?>
                        <div class="page-btn--next border_radius--small disable-color">
                            <span class="page-text page-text--next disable-text disable-text">次へ</span>
                        </div>
                        <?php } ?>
                    <!-- 最後へボタン -->
                    <?php if($now_res < $pages_res){ ?>
                        <div class="page-btn--last enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_responsetab&adminpage_id_res=<?php echo $pages_res;?>' class="page-text page-text--last enable-text">最後へ</a>
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
            <div id="admingood_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($goodthread as $goodthre){
                            if(($goodthre['delete_flag'] != 1 && ($goodthre['res_delete_flag'] == 0 && $goodthre['res_thread_delete_flag'] == 0) || $_SESSION['login'] == 1)){ ?>
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
                                                    <?php if($goodthre['delete_flag'] == 0){ ?>
                                                        <div class="contents__delete">
                                                            <a class="jump" href="../controller/adminpage_controller.php?thread_id=<?php echo $goodthre['id']; ?>&delete_flag=1" 
                                                                onclick="return confirm('選択したスレッドを削除しますか？')">
                                                                削除
                                                            </a>
                                                        </div>
                                                    <?php }elseif($goodthre['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                        <div class="contents__recover">
                                                            <a class="jump" href="../controller/adminpage_controller.php?thread_id=<?php echo $goodthre['id']; ?>&recover_flag=1">復元</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <div>
                                            <?php
                                            }
                                            if (isset($goodthre['good_id'])) {
                                            ?>
                                                <div class="contents__good">いいね<i class="fa-regular fa-star goldstar"></i></div>
                                            <?php
                                            }
                                            else {
                                            ?>
                                                <div class="contents__good">いいね<i class="fa-regular fa-star whitestar"></i></div>
                                            <?php
                                            }
                                            ?>
                                                <input type="hidden" value="type1">
                                                <input type="hidden" value="<?php echo $goodthre['good_id']; ?>">
                                                <input type="hidden" value="<?php echo $goodthre['target_id']; ?>">
                                            </div>
                                        </div>
                                    <!-- 削除復元ボタン・レス -->
                                    <?php }elseif($goodthre['type'] == 2){ ?>
                                        <div class="contents__sub">
                                            <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                            <?php if(isset($_SESSION['login'])){ ?>
                                                <div class="contents__admin">
                                                    <?php if($goodthre['res_delete_flag'] == 0){ ?>
                                                        <div class="contents__delete">
                                                            <a class="jump" href="../controller/adminpage_controller.php?response_id=<?php echo $goodthre['res_id']; ?>&delete_flag=2" 
                                                                onclick="return confirm('選択したレスを削除しますか？')">
                                                                削除
                                                            </a>
                                                        </div>
                                                    <?php }elseif($goodthre['res_delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                        <div class="contents__recover">
                                                            <a class="jump" href="../controller/adminpage_controller.php?response_id=<?php echo $goodthre['res_id']; ?>&recover_flag=2">復元</a>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <div>
                                            <?php
                                            }
                                            if (isset($goodthre['good_id'])) {
                                            ?>
                                                <div class="contents__good">いいね<i class="fa-regular fa-star goldstar"></i></div>
                                            <?php
                                            }
                                            else {
                                            ?>
                                                <div class="contents__good">いいね<i class="fa-regular fa-star whitestar"></i></div>
                                            <?php
                                            }
                                            ?>
                                                <input type="hidden" value="type2">
                                                <input type="hidden" value="<?php echo $goodthre['good_id']; ?>">
                                                <input type="hidden" value="<?php echo $goodthre['target_id']; ?>">
                                            </div>
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
                            <a href='../controller/adminpage_controller.php?tab=admin_goodtab&adminpage_id_good=1' class="page-text page-text--first enable-text">最初へ</a>
                        </div>
                        <?php }else{ ?>
                        <div class="page-btn--first disable-color">
                            <span class="page-text page-text--first disable-text">最初へ</span>
                        </div>
                        <?php } ?>
                    <!-- 前へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <div class="page-btn--previous border_radius--small enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_goodtab&adminpage_id_good=<?php echo ($now_good - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                        </div>
                        <?php }else{?>
                        <div class="page-btn--previous border_radius--small disable-color">
                            <span class="page-text page-text--previous disable-text">前へ</span>
                        </div>
                        <?php } ?>
                    <!-- 次へボタン -->
                    <?php if($now_good < $pages_good){ ?>
                        <div class="page-btn--next border_radius--small enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_goodtab&adminpage_id_good=<?php echo ($now_good + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                        </div>
                        <?php }else{?>
                        <div class="page-btn--next border_radius--small disable-color">
                            <span class="page-text page-text--next disable-text disable-text">次へ</span>
                        </div>
                        <?php } ?>
                    <!-- 最後へボタン -->
                    <?php if($now_good < $pages_good){ ?>
                        <div class="page-btn--last enable-color">
                            <a href='../controller/adminpage_controller.php?tab=admin_responsetab&adminpage_id_good=<?php echo $pages_good;?>' class="page-text page-text--last enable-text">最後へ</a>
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
<?php $js_url = "js/good.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>