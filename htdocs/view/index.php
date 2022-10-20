<!-- headのタイトル -->
<?php $title = "研修掲示板トップページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/top.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>
<!-- sessionから変数へ代入 -->
<?php
    // スレッドが取得できないとき遷移
    if(!isset($_SESSION['newthread']) && !isset($_SESSION['resthread']) && !isset($_SESSION['goodthread']) && !isset($_GET['keyword'])){
        header("Location:../controller/index_controller.php");
    }
    // それ以外のとき変数に代入
    $newthread = $_SESSION['newthread'];
    $resthread = $_SESSION['resthread'];
    $goodthread = $_SESSION['goodthread'];

    $pages = $_SESSION['page'];

    $now = $_SESSION['now'];
    $now_res = $_SESSION['now_res'];
    $now_good = $_SESSION['now_good'];

    // タブを押していないとき最近作成されたスレッドを表示させる
    if(!isset($_GET['tab'])){
        $_GET['tab'] = "new_threadtab";
    }
?>
<!-- main -->
<main>
    <div class="top">
        <!-- 検索したとき戻るボタンを表示する -->
        <?php if(isset($_GET['keyword'])){ ?>
            <div class="top-position">
                <!-- <button class="btn btn--back" type="button" onclick="history.back();">戻る</button> -->
                <!-- トップへ戻る -->
                <button class="btn btn--back" type="button" onclick="location.href='../controller/index_controller.php'">戻る</button>
                <div></div>
                <div></div>
            </div>
        <?php } ?>
        <!-- 検索フォーム -->
        <form class="search" action="../controller/index_controller.php" method="get">
            <input class="search__input" type="search" size="25" name='keyword' placeholder="キーワード入力" value="<?php if( !empty($_GET['keyword']) ){ echo $_GET['keyword']; } ?>" required>
            <button class="search__button border_radius--small" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <!-- 検索したとき表示する -->
        <?php if(isset($_GET['keyword'])){ ?>
            <div class="keyword font-size--20">検索結果:<?php echo $_GET['keyword']; ?></div>
        <?php } ?>
        <!-- ヒットしなかったとき(検索してpagesが0の時)エラーメッセージ表示 -->
        <?php if($pages == 0 && isset($_GET['keyword'])){ ?>
            <div class="nohit"><p>キーワードがヒットしませんでした。<br>キーワードを変更して再度検索してみてください。</p></div>
        <?php }else{ ?>
            <!-- pagesが1以上の時スレッドを表示する -->
            <div class="tab font-size--15">
                <!-- inputのidとlabelのforが対になる -->
                <input class="target" id="new_threadtab" type="radio" name="tab_item" <?php if($_GET['tab']=="new_threadtab") echo 'checked'; ?>>
                <label class="tab_item" for="new_threadtab">最近作成されたスレッド</label>
                <input class="target" id="many_responsetab" type="radio" name="tab_item" <?php if($_GET['tab']=="many_responsetab") echo 'checked'; ?>>
                <label class="tab_item" for="many_responsetab">レスの多い順</label>
                <input class="target" id="many_goodtab" type="radio" name="tab_item" <?php if($_GET['tab']=="many_goodtab") echo 'checked'; ?>>
                <label class="tab_item" for="many_goodtab">いいねの多い順</label>
                <!-- idを任意のものに変える -->
                <div id="thread_content" class="tab__switching">
                    <ul>
                        <?php //スレッド表示
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
                        <?php if($now >= 2){ 
                            if(isset($_GET['keyword'])){?>
                                <div class="page-btn--first">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=1&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first">最初へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--first">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=1' class="page-text page-text--first">最初へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--first">
                                <span  class="page-text page-text--first">最初へ</span>
                            </div>
                        <?php } ?>

                    <!-- 前へボタン -->
                        <?php if($now >= 2){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now - 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous">前へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--previous border_radius--small">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now - 1);?>' class="page-text page-text--previous">前へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small">
                                <span class="page-text page-text--previous">前へ</span>
                            </div>
                        <?php } ?>

                    <!-- 次へボタン -->
                        <?php if($now < $pages){ 
                            if(isset($_GET['keyword'])){//keywordの有無で遷移先を変える ?>
                                <div class="page-btn--next border_radius--small">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now + 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next">次へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--next border_radius--small">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now + 1);?>' class="page-text page-text--next">次へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--next border_radius--small">
                                <span class="page-text page-text--next">次へ</span>
                            </div>
                        <?php } ?>

                    <!-- 最後へボタン -->
                        <?php if($now < $pages){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo $pages;?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last">最後へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--last">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo $pages;?>' class="page-text page-text--last">最後へ</a>
                                </div>
                            <?php } ?>
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
                        <?php if($now_res >= 2){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=1&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first">最初へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--first">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=1' class="page-text page-text--first">最初へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--first">
                                <span class="page-text page-text--first">最初へ</span>
                            </div>
                        <?php } ?>

                    <!-- 前へボタン -->
                        <?php if($now_res >= 2){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res - 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous">前へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--previous border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res - 1);?>' class="page-text page-text--previous">前へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small">
                                <span class="page-text page-text--previous">前へ</span>
                            </div>
                        <?php } ?>

                    <!-- 次へボタン -->
                        <?php if($now_res < $pages){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div  class="page-btn--next border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res + 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next">次へ</a>
                                </div>
                            <?php }else{ ?>
                                <div  class="page-btn--next border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res + 1);?>' class="page-text page-text--next">次へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div  class="page-btn--next border_radius--small">
                                <span class="page-text page-text--next">次へ</span>
                            </div>
                            
                        <?php } ?>

                    <!-- 最後へボタン -->
                        <?php if($now_res < $pages){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo $pages;?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last">最後へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--last">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo $pages;?>' class="page-text page-text--last">最後へ</a>
                                </div>
                            <?php } ?>
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
                        <?php if($now_good >= 2){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=1&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first">最初へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--first">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=1' class="page-text page-text--first">最初へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--first">
                                <span class="page-text page-text--first">最初へ</span>
                            </div>
                        <?php } ?>

                    <!-- 前へボタン -->
                        <?php if($now_good >= 2){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good - 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous">前へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--previous border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good - 1);?>' class="page-text page-text--previous">前へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small">
                                <span class="page-text page-text--previous">前へ</span>
                            </div>
                        <?php } ?>

                    <!-- 次へボタン -->
                        <?php if($now_good < $pages){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div  class="page-btn--next border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good + 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next">次へ</a>
                                </div>
                            <?php }else{ ?>
                                <div  class="page-btn--next border_radius--small">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good + 1);?>' class="page-text page-text--next">次へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div  class="page-btn--next border_radius--small">
                                <span class="page-text page-text--next">次へ</span>
                            </div>
                        <?php } ?>

                    <!-- 最後へボタン -->
                        <?php if($now_good < $pages){ 
                            if(isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo $pages;?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last">最後へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--last">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo $pages;?>' class="page-text page-text--last">最後へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--last">
                                <span class="page-text page-text--last">最後へ</span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php $js_url = "js/index.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>