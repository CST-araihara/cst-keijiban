<?php session_start(); ?>
<!-- headのタイトル -->
<?php $title = "研修掲示板トップページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/top.css"; ?>

<?php
    if(!isset($_SESSION['newthread']) && !isset($_SESSION['resthread']) && !isset($_SESSION['goodthread'])){
        header("Location:../controller/index_controller.php");
    }
    if(isset($_SESSION['newthread'])){ 
        $newthread = $_SESSION['newthread'];
    }
    if(isset($_SESSION['resthread'])){ 
        $resthread = $_SESSION['resthread'];
    }
    if(isset($_SESSION['goodthread'])){ 
        $goodthread = $_SESSION['goodthread'];
    }
    if(isset($_SESSION['page'])){ 
        $pages = $_SESSION['page'];
    }else{
        $pages=1;
    }

    if(isset($_GET['page_id'])){ 
        $_SESSION['now'] = $_GET['page_id'];
    }
    if(isset($_SESSION['now'])){ 
        $now = $_SESSION['now'];
    }else{
        $now = 1;
    }

    if(isset($_GET['page_id_res'])){ 
        $_SESSION['now_res'] = $_GET['page_id_res'];
    }
    if(isset($_SESSION['now_res'])){
        $now_res = $_SESSION['now_res'];
    }else{
        $now_res = 1;
    }

    if(isset($_GET['page_id_good'])){ 
        $_SESSION['now_good'] = $_GET['page_id_good'];
    }
    if(isset($_SESSION['now_good'])){
        $now_good = $_SESSION['now_good'];
    }else{
        $now_good = 1;
    }

    if(!isset($_GET['tab'])){
        $_GET['tab']="new_threadtab";
    }

?>

<!-- header共通部分 -->
<?php include("components/header.php"); ?>
<!-- main -->
<main>
    <div class="top">
        <form class="search" action="#" method="get">
            <input class="search__input" type="search" size="25" placeholder="キーワード入力">
            <button class="search__button border_radius--small" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <div class="tab font-size--15">
            <!-- inputのidとlabelのforが対になる -->
            <input  class="target" id="new_threadtab" type="radio" name="tab_item"  <?php if($_GET['tab']=="new_threadtab") echo 'checked'; ?>>
            <label class="tab_item" for="new_threadtab">最近作成されたスレッド</label>
            <input  class="target" id="many_responsetab" type="radio" name="tab_item" <?php if($_GET['tab']=="many_responsetab") echo 'checked'; ?>>
            <label class="tab_item" for="many_responsetab">レスの多い順</label>
            <input  class="target" id="many_goodtab" type="radio" name="tab_item" <?php if($_GET['tab']=="many_goodtab") echo 'checked'; ?>>
            <label class="tab_item" for="many_goodtab">いいねの多い順</label>
            <!-- idを任意のものに変える -->
            <div id="thread_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($newthread as $newthre){
                    ?>
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <div class="contents__ribbon">
                                    <?php //カテゴリ
                                        echo $newthre['category_name'];
                                    ?>
                                </div>
                                <p class="contents__title contents__char-center">
                                    <?php //最近作成されたタイトル
                                        echo $newthre['title'];
                                    ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php //時間 / HN / レス数(XX)
                                        echo $newthre['datetime']."/".$newthre['handlename']."/レス(".$newthre['rescount'].")";
                                    ?>
                                </div>
                            </div>
                            <div class="contents__bottom">
                                <div class="contents__detail contents__char-top">
                                    <?php //スレッド内容
                                        echo $newthre['contents'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="contents__sub">
                            <div class="contents__admin">
                                <div class="contents__delete">
                                    <a href="#">削除</a>
                                </div>
                                <div class="contents__recover">
                                    <a href="#">復元</a>
                                </div>
                            </div>
                            <div class="contents__good">
                                いいね<i class="fa-regular fa-star"></i>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <div class="page-btn">
                <!-- 最初へボタン -->
                    <?php if($now >= 2){ ?>
                        <div class="page-btn--first">
                            <a href='../controller/index_controller.php?page_id=1' class="page-text page-text--first">最初へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--first">
                            <span  class="page-text page-text--first">最初へ</span>
                        </div>
                    <?php } ?>

                <!-- 前へボタン -->
                    <?php if($now >= 2){ ?>
                        <div class="page-btn--previous border_radius--small">
                            <a href='../controller/index_controller.php?page_id=<?php echo ($now - 1);?>' class="page-text page-text--previous">前へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--previous border_radius--small">
                            <span class="page-text page-text--previous">前へ</span>
                        </div>
                    <?php } ?>

                <!-- 次へボタン -->
                    <?php if($now < $pages){ ?>
                        <div class="page-btn--next border_radius--small">
                            <a href='../controller/index_controller.php?page_id=<?php echo ($now + 1);?>' class="page-text page-text--next">次へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--next border_radius--small">
                            <span class="page-text page-text--next">次へ</span>
                        </div>
                    <?php } ?>

                <!-- 最後へボタン -->
                    <?php if($now < $pages){ ?>
                        <div class="page-btn--last">
                            <a href='../controller/index_controller.php?page_id=<?php echo $pages;?>' class="page-text page-text--last">最後へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--last">
                            <span class="page-text page-text--last">最後へ</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
            <!-- idを任意のものに変える -->
            <div id="response_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($resthread as $resthre){
                    ?>
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <div class="contents__ribbon">
                                    <?php //カテゴリ
                                        echo $resthre['category_name'];
                                    ?>
                                </div>
                                <p class="contents__title contents__char-center">
                                    <?php //レス数の多いタイトル
                                        echo $resthre['title'];
                                    ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php //時間 / HN / レス数（XX）
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
                            </div>
                        </div>
                        <div class="contents__sub">
                            <div class="contents__admin">
                                <div class="contents__delete">
                                    <a href="#">削除</a>
                                </div>
                                <div class="contents__recover">
                                    <a href="#">復元</a>
                                </div>
                            </div>
                            <div class="contents__good">
                                いいね<i class="fa-regular fa-star"></i>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <div class="page-btn">
                <!-- 最初へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <div class="page-btn--first">
                            <a href='../controller/index_controller.php?page_id_res=1' class="page-text page-text--first">最初へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--first">
                            <span class="page-text page-text--first">最初へ</span>
                        </div>
                    <?php } ?>

                <!-- 前へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <div class="page-btn--previous border_radius--small">
                            <a href='../controller/index_controller.php?page_id_res=<?php echo ($now_res - 1);?>' class="page-text page-text--previous">前へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--previous border_radius--small">
                            <span class="page-text page-text--previous">前へ</span>
                        </div>
                    <?php } ?>

                <!-- 次へボタン -->
                    <?php if($now_res < $pages){ ?>
                        <div  class="page-btn--next border_radius--small">
                            <a href='../controller/index_controller.php?page_id_res=<?php echo ($now_res + 1);?>' class="page-text page-text--next">次へ</a>
                        </div>
                        
                    <?php }else{ ?>
                        <div  class="page-btn--next border_radius--small">
                            <span class="page-text page-text--next">次へ</span>
                        </div>
                        
                    <?php } ?>

                <!-- 最後へボタン -->
                    <?php if($now_res < $pages){ ?>
                        <div class="page-btn--last">
                            <a href='../controller/index_controller.php?page_id_res=<?php echo $pages;?>' class="page-text page-text--last">最後へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--last">
                            <span class="page-text page-text--last">最後へ</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
            <!-- idを任意のものに変える -->
            <div id="good_content" class="tab__switching">
                <ul>
                    <?php 
                        foreach($goodthread as $goodthre){
                    ?>
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <div class="contents__ribbon">
                                    <?php //カテゴリ
                                        echo $goodthre['category_name'];
                                    ?>
                                </div>
                                <p class="contents__title contents__char-center">
                                    <?php //いいねの多いタイトル
                                        echo $goodthre['title'];
                                    ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php //時間 / HN / いいね数（XX）
                                        echo $goodthre['datetime']."/".$goodthre['handlename']."/いいね(".$goodthre['goodcount'].")";
                                    ?>
                                </div>
                            </div>
                            <div class="contents__bottom">
                                <div class="contents__detail contents__char-top">
                                    <?php //スレッド内容
                                        echo $goodthre['contents'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="contents__sub">
                            <div class="contents__admin">
                                <div class="contents__delete">
                                    <a href="#">削除</a>
                                </div>
                                <div class="contents__recover">
                                    <a href="#">復元</a>
                                </div>
                            </div>
                            <div class="contents__good">
                                いいね<i class="fa-regular fa-star"></i>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <div  class="page-btn">
                <!-- 最初へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <div class="page-btn--first">
                            <a href='../controller/index_controller.php?page_id_good=1' class="page-text page-text--first">最初へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--first">
                            <span class="page-text page-text--first">最初へ</span>
                        </div>
                    <?php } ?>

                <!-- 前へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <div class="page-btn--previous border_radius--small">
                            <a href='../controller/index_controller.php?page_id_good=<?php echo ($now_good - 1);?>' class="page-text page-text--previous">前へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--previous border_radius--small">
                            <span class="page-text page-text--previous">前へ</span>
                        </div>
                    <?php } ?>

                <!-- 次へボタン -->
                    <?php if($now_good < $pages){ ?>
                        <div  class="page-btn--next border_radius--small">
                            <a href='../controller/index_controller.php?page_id_good=<?php echo ($now_good + 1);?>' class="page-text page-text--next">次へ</a>
                        </div>
                    <?php }else{ ?>
                        <div  class="page-btn--next border_radius--small">
                            <span class="page-text page-text--next">次へ</span>
                        </div>
                    <?php } ?>

                <!-- 最後へボタン -->
                    <?php if($now_good < $pages){ ?>
                        <div class="page-btn--last">
                            <a href='../controller/index_controller.php?page_id_good=<?php echo $pages;?>' class="page-text page-text--last">最後へ</a>
                        </div>
                    <?php }else{ ?>
                        <div class="page-btn--last">
                            <span class="page-text page-text--last">最後へ</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $js_url = "js/index.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>