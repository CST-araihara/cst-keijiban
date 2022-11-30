<!-- headのタイトル -->
<?php $title = "研修掲示板トップページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/top.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>
<!-- sessionから変数へ代入 -->
<?php
    // スレッドが取得できないとき遷移
    if((!isset($_SESSION['newthread']) || !isset($_SESSION['resthread']) || !isset($_SESSION['goodthread'])) && !isset($_GET['keyword'])){
        header("Location:../controller/index_controller.php");
    }
    // それ以外のとき変数に代入
    $newthread = $_SESSION['newthread'];
    $resthread = $_SESSION['resthread'];
    $goodthread = $_SESSION['goodthread'];

    $pages = $_SESSION['page'];
    $now_res = $_SESSION['now_res'];
    $now = $_SESSION['now'];
    $now_good = $_SESSION['now_good'];

    // タブを押していないとき最近作成されたスレッドを表示させる
    if(!isset($_GET['tab'])){
        $_GET['tab'] = "new_threadtab";
    }

    // print_r($resthread);

?>
<!-- main -->
<main>
    <div class="top">
        <!-- 検索したとき戻るボタンを表示する -->
        <?php if(isset($_GET['keyword'])||isset($_GET['category']) ||isset($_GET['terms1'])){ ?>
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
            <input class="search__input" type="search" size="25" name='keyword' placeholder="キーワード入力" value="<?php if( !empty($_GET['keyword']) ){ echo $_GET['keyword']; } ?>" ?>
            <select class="search__select" name="category" id="">
                <option value="選択無し">-</option>
                <?php foreach ($category as $row) { 
                    if($_GET['category']==$row['category_name']){ ?>
                        <option value="<?php echo $row['category_name']; ?>" selected><?php echo $row['category_name']; ?></option>
                    <?php }else{ ?>
                        <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <button class="search__button border_radius--small" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <!-- 検索したとき表示する -->
        <?php if(isset($_GET['category']) && isset($_GET['keyword']) && $_GET['keyword']==""){?>
            <div class="keyword font-size--20">カテゴリー:<?php echo $_GET['category']; ?></div>
        <?php }elseif(isset($_GET['keyword']) && isset($_GET['category'])){ ?>
            <div class="keyword font-size--20">カテゴリー:<?php echo $_GET['category']; ?>/キーワード:<?php if($_GET['keyword']==""){echo "入力されていません";}else{echo $_GET['keyword'];} ?></div>
        <?php }elseif(isset($_GET['category'])){ ?>
            <div class="keyword font-size--20">カテゴリー:<?php echo $_GET['category']; ?></div>
        <?php }elseif(!isset($_GET['category']) && isset($_GET['word'])){ ?>
            <div class="keyword font-size--20">"<?php echo $_GET['word']; ?>"を含む<?php echo $_GET['terms1']; ?>で<?php echo $_GET['terms2']; ?>を検索</div>
        <?php } ?>

        <!-- ヒットしなかったとき(検索してpagesが0の時)エラーメッセージ表示 -->
        <?php if($pages == 0 && isset($_GET['keyword']) && isset($_GET['category'])){ ?>
            <div class="nohit"><p>選択したカテゴリ内のキーワードがヒットしませんでした。<br>キーワードかカテゴリを変更して再度検索してみてください。</p></div>
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
                                if($newthre['delete_flag'] == 0 || (isset($_SESSION['login']) && $_SESSION['login'] == 1)){
                        ?>
                            <li class="tab__contents">
                                <a class="thread" href="../controller/threadDetail_controller.php?thread_id=<?php echo $newthre['id']; ?>">
                                    <div class="contents__main">
                                        <div class="contents__top">
                                            <div class="contents__ribbon" 
                                                style="background-color:<?php echo $newthre['main_colorcode']; ?>;">
                                                <div class="contents__ribbon-before" 
                                                    style="border-top: 3px solid <?php echo $newthre['sub_colorcode']; ?>;
                                                        border-right: 3px solid  <?php  echo $newthre['sub_colorcode']; ?>;">
                                                </div>
                                                    <?php //カテゴリ
                                                        echo $newthre['category_name'];
                                                    ?>
                                                <div class="contents__ribbon-after" 
                                                    style="border-top: 10px solid <?php  echo $newthre['main_colorcode']; ?>;
                                                        border-right: 10px solid transparent;
                                                        border-bottom: 10px solid <?php  echo $newthre['main_colorcode']; ?>;
                                                        border-left: 0 solid <?php  echo $newthre['main_colorcode'];?>;">
                                                </div>
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
                                </a>
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
                        <?php }
                            } ?>
                    </ul>
                    <div class="page-btn">
                    <!-- 最初へボタン -->
                        <?php if($now >= 2){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=1&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=1&category=<?php echo $_GET['category']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=1&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=1' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--first disable-color">
                                <span class="page-text page-text--first disable-text">最初へ</span>
                            </div>
                        <?php } ?>
                    <!-- 前へボタン -->
                        <?php if($now >= 2){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now - 1);?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now - 1);?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now - 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small disable-color">
                                <span class="page-text page-text--previous disable-text">前へ</span>
                            </div>
                        <?php } ?>
                    <!-- 次へボタン -->
                        <?php if($now < $pages){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now + 1);?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now + 1);?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now + 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo ($now + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php } 
                        }else{ ?>
                            <div class="page-btn--next border_radius--small disable-color">
                                <span class="page-text page-text--next disable-text disable-text">次へ</span>
                            </div>
                        <?php } ?>
                    <!-- 最後へボタン -->
                        <?php if($now < $pages){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo $pages;?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo $pages;?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo $pages;?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=new_threadtab&page_id=<?php echo $pages;?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--last disable-color">
                                <span class="page-text page-text--last disable-text">最後へ</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagecount"><?php echo $now ?>/<?php echo $pages ?>ページ</div>
                </div>
                
                <!-- idを任意のものに変える -->
                <div id="response_content" class="tab__switching">
                    <ul>
                        <?php 
                            foreach($resthread as $resthre){
                                if($resthre['delete_flag'] == 0 || (isset($_SESSION['login']) && $_SESSION['login'] == 1)){
                        ?>
                        <li class="tab__contents">
                            <a class="thread" href="../controller/threadDetail_controller.php?thread_id=<?php echo $resthre['id']; ?>">
                                <div class="contents__main">
                                    <div class="contents__top">
                                        <div class="contents__ribbon"
                                            style="background-color:<?php echo $resthre['main_colorcode']; ?>;">
                                            <div class="contents__ribbon-before" 
                                                style="border-top: 3px solid <?php echo $resthre['sub_colorcode']; ?>;
                                                    border-right: 3px solid  <?php  echo $resthre['sub_colorcode']; ?>;">
                                            </div>
                                                <?php //カテゴリ
                                                    echo $resthre['category_name'];
                                                ?>
                                            <div class="contents__ribbon-after" 
                                                style="border-top: 10px solid <?php  echo $resthre['main_colorcode']; ?>;
                                                    border-right: 10px solid transparent;
                                                    border-bottom: 10px solid <?php  echo $resthre['main_colorcode']; ?>;
                                                    border-left: 0 solid <?php  echo $resthre['main_colorcode'];?>;">
                                            </div>
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
                            </a>
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
                        <?php }
                            } ?>
                    </ul>
                    <div class="page-btn">
                    <!-- 最初へボタン -->
                        <?php if($now_res >= 2){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=1&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=1&category=<?php echo $_GET['category']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=1&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=1' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--first disable-color">
                                <span class="page-text page-text--first disable-text">最初へ</span>
                            </div>
                        <?php } ?>

                    <!-- 前へボタン -->
                        <?php if($now_res >= 2){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res - 1);?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res - 1);?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res - 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small disable-color">
                                <span class="page-text page-text--previous disable-text">前へ</span>
                            </div>
                        <?php } ?>

                    <!-- 次へボタン -->
                        <?php if($now_res < $pages){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res + 1);?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res + 1);?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div  class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res + 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else{ ?>
                                <div  class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo ($now_res + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div  class="page-btn--next border_radius--small disable-color">
                                <span class="page-text page-text--next disable-text">次へ</span>
                            </div>
                        <?php } ?>

                    <!-- 最後へボタン -->
                        <?php if($now_res < $pages){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo $pages;?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo $pages;?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo $pages;?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_responsetab&page_id_res=<?php echo $pages;?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--last disable-color">
                                <span class="page-text page-text--last disable-text">最後へ</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagecount"><?php echo $now_res ?>/<?php echo $pages ?>ページ</div>
                </div>
                
                <!-- idを任意のものに変える -->
                <div id="good_content" class="tab__switching">
                    <ul>
                        <?php 
                            foreach($goodthread as $goodthre){
                                if($goodthre['delete_flag'] == 0 || (isset($_SESSION['login']) && $_SESSION['login'] == 1)){
                        ?>
                        <li class="tab__contents">
                            <a class="thread" href="../controller/threadDetail_controller.php?thread_id=<?php echo $goodthre['id']; ?>">
                                <div class="contents__main">
                                    <div class="contents__top">
                                    <div class="contents__ribbon" 
                                            style="background-color:<?php echo $goodthre['main_colorcode']; ?>;">
                                            <div class="contents__ribbon-before" 
                                                style="border-top: 3px solid <?php echo $goodthre['sub_colorcode']; ?>;
                                                    border-right: 3px solid  <?php  echo $goodthre['sub_colorcode']; ?>;">
                                            </div>
                                                <?php //カテゴリ
                                                    echo $goodthre['category_name'];
                                                ?>
                                            <div class="contents__ribbon-after" 
                                                style="border-top: 10px solid <?php  echo $goodthre['main_colorcode']; ?>;
                                                    border-right: 10px solid transparent;
                                                    border-bottom: 10px solid <?php  echo $goodthre['main_colorcode']; ?>;
                                                    border-left: 0 solid <?php  echo $goodthre['main_colorcode'];?>;">
                                            </div>
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
                                        <?php if(isset($goodthre['upload_file_path'])){ ?>
                                            <div class="contents__imgicon">
                                                <?php if(preg_match('/.mp4/',$goodthre['upload_file_path'])){ ?>
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
                            </a>
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
                        <?php }
                            } ?>
                    </ul>
                    <div  class="page-btn">
                    <!-- 最初へボタン -->
                        <?php if($now_good >= 2){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=1&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?PHP }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=1&category=<?php echo $_GET['category']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?> 
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=1&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--first enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=1' class="page-text page-text--first enable-text">最初へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--first disable-color">
                                <span class="page-text page-text--first disable-text">最初へ</span>
                            </div>
                        <?php } ?>

                    <!-- 前へボタン -->
                        <?php if($now_good >= 2){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good - 1);?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good - 1);?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good - 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--previous border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good - 1);?>' class="page-text page-text--previous enable-text">前へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--previous border_radius--small disable-color">
                                <span class="page-text page-text--previous disable-text">前へ</span>
                            </div>
                        <?php } ?>

                    <!-- 次へボタン -->
                        <?php if($now_good < $pages){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good+ 1);?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good + 1);?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div  class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good + 1);?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php }else{ ?>
                                <div  class="page-btn--next border_radius--small enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo ($now_good + 1);?>' class="page-text page-text--next enable-text">次へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div  class="page-btn--next border_radius--small disable-color">
                                <span class="page-text page-text--next disable-text">次へ</span>
                            </div>
                        <?php } ?>

                    <!-- 最後へボタン -->
                        <?php if($now_good < $pages){ 
                            if(isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo $pages;?>&category=<?php echo $_GET['category']; ?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else if(isset($_GET['category']) && !isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo $pages;?>&category=<?php echo $_GET['category']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else if(!isset($_GET['category']) && isset($_GET['keyword'])){ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo $pages;?>&keyword=<?php echo $_GET['keyword']; ?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php }else{ ?>
                                <div class="page-btn--last enable-color">
                                    <a href='../controller/index_controller.php?tab=many_goodtab&page_id_good=<?php echo $pages;?>' class="page-text page-text--last enable-text">最後へ</a>
                                </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="page-btn--last disable-color">
                                <span class="page-text page-text--last disable-text">最後へ</span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagecount"><?php echo $now_good ?>/<?php echo $pages ?>ページ</div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<?php $js_url = "js/index.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>