<!-- headのタイトル -->
<?php $title = "研修掲示板トップページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/top.css"; ?>

<?php
    include('../model/PDO_Connect.php');

    $dbh = connect();
    //一ページに表示する記事の数をmax_viewに定数として定義
    define('max_view',10);
    //必要なページ数を求める
    $count = $dbh->prepare('SELECT COUNT(*) AS count FROM thread');
    $count->execute();
    $total_count = $count->fetch(PDO::FETCH_ASSOC);
    $pages = ceil($total_count['count'] / max_view);

    // 最近作成されたスレッド
    //現在いるページのページ番号を取得
    if(!isset($_GET['page_id'])){ 
        $now = 1;
    }else{
        $now = $_GET['page_id'];
    }
    $newstmt = $dbh->prepare("select category_name,title,contents,handlename,datetime,(select count(*) from response where thread_id=thread.id) AS rescount
                        from thread 
                        inner join users on thread.user_id=users.id 
                        inner join category on category.id=thread.category_id
                        ORDER BY datetime DESC
                        LIMIT :start,:max ;"
                    );
    if ($now == 1){
        //1ページ目の処理
        $newstmt->bindValue(":start",$now -1,PDO::PARAM_INT);
        $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
    } else {
        //1ページ目以外の処理
        $newstmt->bindValue(":start",($now -1 ) * max_view,PDO::PARAM_INT);
        $newstmt->bindValue(":max",max_view,PDO::PARAM_INT);
    }
    //実行し結果を取り出しておく
    $newstmt->execute();
    $newthread = $newstmt->fetchAll(PDO::FETCH_BOTH);

    // レスの多い順
    //現在いるページのページ番号を取得
    if(!isset($_GET['page_id_res'])){ 
        $now_res = 1;
    }else{
        $now_res = $_GET['page_id_res'];
    }
    $resstmt = $dbh->prepare("select category_name,title,contents,handlename,datetime,(select count(*) from response where thread_id=thread.id) AS rescount
                        from thread 
                        inner join users on thread.user_id=users.id 
                        inner join category on category.id=thread.category_id
                        ORDER BY rescount DESC
                        LIMIT :start,:max ;"
                    );
    if ($now_res == 1){
        //1ページ目の処理
        $resstmt->bindValue(":start",$now_res -1,PDO::PARAM_INT);
        $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
    } else {
        //1ページ目以外の処理
        $resstmt->bindValue(":start",($now_res -1 ) * max_view,PDO::PARAM_INT);
        $resstmt->bindValue(":max",max_view,PDO::PARAM_INT);
    }
    //実行し結果を取り出しておく
    $resstmt->execute();
    $resthread = $resstmt->fetchAll(PDO::FETCH_BOTH);

    // いいねの多い順
    //現在いるページのページ番号を取得
    if(!isset($_GET['page_id_good'])){ 
        $now_good = 1;
    }else{
        $now_good = $_GET['page_id_good'];
    }

    $goodstmt = $dbh->prepare("select category_name,title,contents,handlename,datetime,(select count(*) from good where target_id=thread.id AND type=1) AS goodcount
                        from thread 
                        inner join users on thread.user_id=users.id 
                        inner join category on category.id=thread.category_id
                        ORDER BY goodcount DESC
                        LIMIT :start,:max ;"
                    );
    if ($now_good == 1){
        //1ページ目の処理
        $goodstmt->bindValue(":start",$now_good -1,PDO::PARAM_INT);
        $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
    } else {
        //1ページ目以外の処理
        $goodstmt->bindValue(":start",($now_good -1 ) * max_view,PDO::PARAM_INT);
        $goodstmt->bindValue(":max",max_view,PDO::PARAM_INT);
    }
    //実行し結果を取り出しておく
    $goodstmt->execute();
    $goodthread = $goodstmt->fetchAll(PDO::FETCH_BOTH);
    // echo $thread[0][1];
?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>
<!-- main -->
<main>
    <!-- ▼たけまさテスト▼ -->
    <input type="hidden" value="a">
    <!-- ▲たけまさテスト▲ -->
    <div class="top">
        <form class="search" action="#" method="get">
            <input class="search__input" type="search" size="25" placeholder="キーワード入力">
            <button class="search__button border_radius--small" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <div class="tab font-size--15">
            <!-- inputのidとlabelのforが対になる -->
            <input id="new_threadtab" type="radio" name="tab_item" <?php if(isset($_GET['page_id'])) {echo 'checked';} ?>>
            <label class="tab_item" for="new_threadtab">最近作成されたスレッド</label>
            <input id="many_responsetab" type="radio" name="tab_item" <?php if(isset($_GET['page_id_res'])) {echo 'checked';} ?>>
            <label class="tab_item" for="many_responsetab">レスの多い順</label>
            <input id="many_goodtab" type="radio" name="tab_item" <?php if(isset($_GET['page_id_good'])) {echo 'checked';} ?>>
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
                <div>
                <!-- 最初へボタン -->
                    <?php if($now >= 2){ ?>
                        <a href='./index.php?page_id=1' style='padding: 5px;'>最初へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>最初へ</span>
                    <?php } ?>
                <!-- 前へボタン -->
                    <?php if($now >= 2){ ?>
                        <a href='./index.php?page_id= <?php echo ($now - 1);?>' style='padding: 5px;'>前へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>前へ</span>
                    <?php } ?>

                <!-- 次へボタン -->
                    <?php if($now < $pages){ ?>
                        <a href='./index.php?page_id= <?php echo ($now + 1);?>' style='padding: 5px;'>次へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>次へ</span>
                    <?php } ?>

                <!-- 最後へボタン -->
                    <?php if($now < $pages){ ?>
                        <a href='./index.php?page_id= <?php echo $pages;?>' style='padding: 5px;'>最後へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>最後へ</span>
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
                <div>
                <!-- 最初へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <a href='./index.php?page_id_res=1' style='padding: 5px;'>最初へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>最初へ</span>
                    <?php } ?>
                <!-- 前へボタン -->
                    <?php if($now_res >= 2){ ?>
                        <a href='./index.php?page_id_res= <?php echo ($now_res - 1);?>' style='padding: 5px;'>前へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>前へ</span>
                    <?php } ?>

                <!-- 次へボタン -->
                    <?php if($now_res < $pages){ ?>
                        <a href='./index.php?page_id_res= <?php echo ($now_res + 1);?>' style='padding: 5px;'>次へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>次へ</span>
                    <?php } ?>

                <!-- 最後へボタン -->
                    <?php if($now_res < $pages){ ?>
                        <a href='./index.php?page_id_res= <?php echo $pages;?>' style='padding: 5px;'>最後へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>最後へ</span>
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
                <div>
                <!-- 最初へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <a href='./index.php?page_id_good=1' style='padding: 5px;'>最初へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>最初へ</span>
                    <?php } ?>
                <!-- 前へボタン -->
                    <?php if($now_good >= 2){ ?>
                        <a href='./index.php?page_id_good= <?php echo ($now_good - 1);?>' style='padding: 5px;'>前へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>前へ</span>
                    <?php } ?>

                <!-- 次へボタン -->
                    <?php if($now_good < $pages){ ?>
                        <a href='./index.php?page_id_good= <?php echo ($now_good + 1);?>' style='padding: 5px;'>次へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>次へ</span>
                    <?php } ?>

                <!-- 最後へボタン -->
                    <?php if($now_good < $pages){ ?>
                        <a href='./index.php?page_id_good= <?php echo $pages;?>' style='padding: 5px;'>最後へ</a>
                    <?php }else{ ?>
                        <span style='padding: 5px;'>最後へ</span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>