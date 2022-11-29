<!-- headのタイトル -->
<?php $title = "研修掲示板スレッド詳細ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/threadDetail.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php 
    $thread = $_SESSION['thread'];

    $newrespons = $_SESSION['new_response'];
    $oldrespons = $_SESSION['old_response'];

    //共通（ページ数）
    $pages = $_SESSION['res_page'];

    $now_newres = $_SESSION['newres_now'];
    $now_oldres = $_SESSION['oldres_now'];

    // タブを押していないとき最近作成されたスレッドを表示させる
    if(!isset($_GET['res_tab'])){
        $_GET['res_tab'] = "new_responsetab";
    }

    // print_r($newrespons);
    // print_r($oldrespons);
    // print_r($thread);

?>

<main class="font-size--15">
    <div class="threadDatail">
        <div class="threadDatail-position">
            <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
            <div></div>
            <div></div>
        </div>
        <div class="thread">
            <div class="contents__main">
                <div class="contents__top">
                    <div class="contents__ribbon" 
                        style="background-color:<?php echo $thread['main_colorcode']; ?>;">
                        <div class="contents__ribbon-before" 
                            style="border-top: 3px solid <?php echo $thread['sub_colorcode']; ?>;
                                border-right: 3px solid  <?php echo $thread['sub_colorcode']; ?>;">
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
                        <img class="contents__icon border_radius--small" src="<?php echo $thread['icon_img_path']; ?>" alt="">
                        <button class="contents__handlename font-size--15" type="button" onclick="location.href='../controller/userdetail_controller.php?friend_id=<?php echo $thread['user_id']; ?>'">
                            <?php //ハンドルネーム
                                echo $thread['handlename']; 
                            ?>
                        </button>
                    </div>
                    <div class="contents__datetime">
                        <?php // 投稿時間
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
            <div class="contents__sub">
                <div class="contents__sub">
                    <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                    <?php if(isset($_SESSION['login'])){ ?>
                        <div class="contents__admin">
                            <?php if(($thread['delete_flag'] == 0 && $_SESSION['login'] == $thread['user_id']) || ($thread['delete_flag'] == 0 && $_SESSION['login'] == 1)){ ?>
                                <div class="contents__delete">
                                    <a href="../controller/threadDetail_controller.php?thread_id=<?php echo $thread['id']; ?>&delete_flag=1" 
                                        onclick="return confirm('選択したスレッドを削除しますか？')">
                                        削除
                                    </a>
                                </div>
                            <?php }elseif($thread['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                <div class="contents__recover">
                                    <a href="#">復元</a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div> -->
                        <div class="contents__good">いいね<i id="star" class="fa-regular fa-star"></i></div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="threadDatail__middle">
            <p class="res-list">レス一覧</p>
            <button class="btn btn--normal" type="button" onclick="location.href='../view/response.php?thread_id=<?php echo $thread['id']; ?>'">スレッドに<br>返信する</button>
        </div>
        <?php if(empty($newrespons)){?>
            <div class="noresponse"><p>このスレッドにはレスが存在しません</p></div>
        <?php }elseif((in_array( '0',array_column($newrespons,'delete_flag'))) == false && (!isset($_SESSION['login']) || $_SESSION['login'] != 1)){ ?>
            <div class="noresponse"><p>このスレッドにはレスが存在しません</p></div>
        <?php }else{ ?>
            <!-- レスの表示 -->
            <div class="tab">
                <!-- inputのidとlabelのforが対になる -->
                <input class="target" id="new_responsetab" type="radio" name="tab_item" <?php if($_GET['res_tab'] == "new_responsetab") echo 'checked'; ?>>
                <label class="tab_item" for="new_responsetab">投稿が新しい順</label>
                <input class="target" id="old_responsetab" type="radio" name="tab_item" <?php if($_GET['res_tab'] == "old_responsetab") echo 'checked'; ?>>
                <label class="tab_item" for="old_responsetab">投稿が古い順</label>
                <!-- レス新しい順 -->
                <div id="newres_content" class="tab__switching">
                    <ul>
                        <?php 
                            foreach($newrespons as $newres){
                                if($newres['delete_flag'] == 0 || (isset($_SESSION['login']) && $_SESSION['login'] == 1)){
                        ?>
                            <li class="tab__contents">
                                <div class="contents__main">
                                    <div class="contents__middle">
                                        <div class="contents__name">
                                            <img class="contents__icon border_radius--small" src="<?php echo $newres['icon_img_path']; ?>" alt="">
                                            <button class="contents__handlename font-size--15" type="button" onclick="location.href='../controller/userdetail_controller.php?friend_id=<?php echo $newres['user_id']; ?>'">
                                                <?php //ハンドルネーム
                                                    echo $newres['handlename']; 
                                                ?>
                                            </button>
                                        </div>
                                        <div class="contents__datetime">
                                            <?php //投稿時間
                                                echo $newres['datetime']; 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="contents__bottom">
                                        <div class="contents__detail contents__char-top">
                                            <?php //レス内容
                                                echo $newres['contents']; 
                                            ?>
                                        </div>
                                        <?php if(isset($newres['upload_file_path'])){ ?>
                                            <div class="contents__file_path">
                                                <?php if(preg_match('/.mp4/',$newres['upload_file_path'])){ ?>
                                                    <video controls src="<?php echo $newres['upload_file_path']; ?>"></video>
                                                <?php }else{ ?>
                                                    <img src="<?php echo $newres['upload_file_path']; ?>" alt="">
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="contents__sub">
                                    <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                    <?php if(isset($_SESSION['login'])){ ?>
                                        <div class="contents__admin">
                                            <?php if(($newres['delete_flag'] == 0 && $_SESSION['login'] == $newres['user_id']) || ($newres['delete_flag'] == 0 && $_SESSION['login'] == 1)){ ?>
                                                <div class="contents__delete">
                                                    <a href="../controller/threadDetail_controller.php?response_id=<?php echo $newres['id']; ?>&thread_id=<?php echo $thread['id']; ?>&delete_flag=2" 
                                                        onclick="return confirm('選択したスレッドを削除しますか？')">
                                                        削除
                                                    </a>
                                                </div>
                                            <?php }elseif($newres['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                                <div class="contents__recover">
                                                    <a href="#">復元</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <!-- <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div> -->
                                        <div class="contents__good">いいね<i id="star" class="fa-regular fa-star"></i></div>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php   }
                            } 
                        ?>
                    </ul>
                    <div class="page-btn">
                        <!-- 最初へボタン -->
                        <?php if($now_newres >= 2){ ?>
                            <div class="page-btn--first enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=new_responsetab&newres_page_id=1&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--first disable-color">
                                <span class="page-text page-text--first disable-text">最初へ</span>
                            </div>
                        <?php } ?>
                        <!-- 前へボタン -->
                        <?php if($now_newres >= 2){ ?>
                            <div class="page-btn--previous border_radius--small enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=new_responsetab&newres_page_id=<?php echo ($now_newres - 1);?>&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small disable-color">
                                <span class="page-text page-text--previous disable-text">前へ</span>
                            </div>
                        <?php } ?>
                        <!-- 次へボタン -->
                        <?php if($now_newres < $pages){ ?>
                            <div class="page-btn--next border_radius--small enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=new_responsetab&newres_page_id=<?php echo ($now_newres + 1);?>&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--next enable-text">次へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--next border_radius--small disable-color">
                                <span class="page-text page-text--next disable-text disable-text">次へ</span>
                            </div>
                        <?php } ?>
                        <!-- 最後へボタン -->
                        <?php if($now_newres < $pages){ ?>
                            <div class="page-btn--last enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=new_responsetab&newres_page_id=<?php echo $pages;?>&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--last disable-color">
                                <span class="page-text page-text--last disable-text">最後へ</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagecount"><?php echo $now_newres ?>/<?php if($pages==0){echo 1;}else{ echo $pages;} ?>ページ</div>
                </div>
                <!-- レス古い順 -->
                <div id="oldres_content" class="tab__switching">
                    <ul>
                        <?php foreach($oldrespons as $oldres){
                            if($oldres['delete_flag'] == 0 || (isset($_SESSION['login']) && $_SESSION['login'] == 1)){ ?>
                        <li class="tab__contents">
                            <div class="contents__main">
                                <div class="contents__middle">
                                    <p class="contents__name">
                                        <img class="contents__icon border_radius--small" src="<?php echo $oldres['icon_img_path']; ?>" alt="">
                                        <button class="contents__handlename font-size--15" type="button" onclick="location.href='../controller/userdetail_controller.php?friend_id=<?php echo $oldres['user_id']; ?>'">
                                            <?php //ハンドルネーム
                                                echo $oldres['handlename']; 
                                            ?>
                                        </button>
                                    </p>
                                    <div class="contents__datetime">
                                        <?php //投稿時間
                                            echo $oldres['datetime']; 
                                        ?>
                                    </div>
                                </div>
                                <div class="contents__bottom">
                                    <div class="contents__detail contents__char-top">
                                        <?php //内容
                                            echo $oldres['contents']; 
                                        ?>
                                    </div>
                                    <?php if(isset($oldres['upload_file_path'])){ ?>
                                        <div class="contents__file_path">
                                            <?php if(preg_match('/.mp4/',$oldres['upload_file_path'])){ ?>
                                                <video controls src="<?php echo $oldres['upload_file_path']; ?>"></video>
                                            <?php }else{ ?>
                                                <img src="<?php echo $oldres['upload_file_path']; ?>" alt="">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="contents__sub">
                                <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                                <?php if(isset($_SESSION['login'])){ ?>
                                    <div class="contents__admin">
                                        <?php if(($oldres['delete_flag'] == 0 && $_SESSION['login'] == $oldres['user_id']) || ($oldres['delete_flag'] == 0 && $_SESSION['login'] == 1)){ ?>
                                            <div class="contents__delete">
                                                <a href="../controller/threadDetail_controller.php?response_id=<?php echo $oldres['id']; ?>&thread_id=<?php echo $thread['id']; ?>&delete_flag=2" 
                                                    onclick="return confirm('選択したスレッドを削除しますか？')">
                                                    削除
                                                </a>
                                            </div>
                                        <?php }elseif($oldres['delete_flag'] == 1 && $_SESSION['login'] == 1){ ?>
                                            <div class="contents__recover">
                                                <a href="#">復元</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <!-- <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div> -->
                                    <div class="contents__good">いいね<i id="star" class="fa-regular fa-star"></i></div>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                    <?php }
                        } ?>
                    <div class="page-btn">
                        <!-- 最初へボタン -->
                        <?php if($now_oldres >= 2){ ?>
                            <div class="page-btn--first enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=old_responsetab&oldres_page_id=1&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--first disable-color">
                                <span class="page-text page-text--first disable-text">最初へ</span>
                            </div>
                        <?php } ?>
                        <!-- 前へボタン -->
                        <?php if($now_oldres >= 2){ ?>
                            <div class="page-btn--previous border_radius--small enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=old_responsetab&oldres_page_id=<?php echo ($now_oldres - 1);?>&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small disable-color">
                                <span class="page-text page-text--previous disable-text">前へ</span>
                            </div>
                        <?php } ?>
                        <!-- 次へボタン -->
                        <?php if($now_oldres < $pages){ ?>
                            <div class="page-btn--next border_radius--small enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=old_responsetab&oldres_page_id=<?php echo ($now_oldres + 1);?>&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--next enable-text">次へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--next border_radius--small disable-color">
                                <span class="page-text page-text--next disable-text disable-text">次へ</span>
                            </div>
                        <?php } ?>
                        <!-- 最後へボタン -->
                        <?php if($now_oldres < $pages){ ?>
                            <div class="page-btn--last enable-color">
                                <a href='../controller/threadDetail_controller.php?res_tab=old_responsetab&oldres_page_id=<?php echo $pages;?>&thread_id=<?php echo $thread['id']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                            </div>
                        <?php }else{ ?>
                            <div class="page-btn--last disable-color">
                                <span class="page-text page-text--last disable-text">最後へ</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagecount"><?php echo $now_oldres ?>/<?php if($pages==0){echo 1;}else{ echo $pages;} ?>ページ</div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php $js_url = "js/threadDetail.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>