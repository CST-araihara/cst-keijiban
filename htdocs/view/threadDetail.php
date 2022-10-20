<!-- headのタイトル -->
<?php $title = "研修掲示板スレッド詳細ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/threadDetail.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>

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
                    <div class="contents__ribbon">
                        <?php echo "カテゴリ"; ?>
                    </div>
                    <p class="contents__title contents__char-center">
                        <?php echo "タイトル"; ?>
                    </p>
                    <div class="contents__datetime contents__char-center">
                        <?php echo "2022/01/01 10:15:30"; ?>
                    </div>
                </div>
                <div class="contents__middle contents__char-top">
                    <?php echo "ハンドルネーム"; ?>
                </div>
                <div class="contents__bottom">
                    <div class="contents__detail contents__char-top">
                        <?php echo "スレッド内容スレッド内容スレッド内容スレッド内容"; ?>
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
        </div>
        <div class="threadDatail__middle">
            <p class="res-list">レス一覧</p>
            <button class="btn btn--normal" type="button" onclick="location.href='response.php'">スレッドに<br>返信する</button>
        </div>

        <div class="tab">
            <!-- inputのidとlabelのforが対になる -->
            <input id="new_restab" type="radio" name="tab_item" checked>
            <label class="tab_item" for="new_restab">投稿が新しい順</label>
            <input id="old_restab" type="radio" name="tab_item">
            <label class="tab_item" for="old_restab">投稿が古い順</label>
            <!-- idを任意のものに変える -->
            <div id="newres_content" class="tab__switching">
                <ul>
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <p class="contents__name contents__char-center">
                                    <?php echo "ハンドルネーム"; ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php echo "2022/01/01 10:30:42"; ?>
                                </div>
                            </div>
                            <div class="contents__bottom">
                                <div class="contents__detail contents__char-top">
                                    <?php echo "レス内容レス内容レス内容レス内容レス内容レス内容"; ?>
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
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <p class="contents__name contents__char-center">
                                    <?php echo "ハンドルネーム"; ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php echo "2022/01/01 10:22:16"; ?>
                                </div>
                            </div>
                            <div class="contents__bottom">
                                <div class="contents__detail contents__char-top">
                                    <?php echo "レス内容レス内容レス内容レス内容レス内容レス内容"; ?>
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
                </ul>
                <div class="page-btn">
                    <div class="page-btn--first">
                        <a href="#" class="page-text page-text--first">最初へ</a>
                    </div>
                    <div class="page-btn--previous border_radius--small">
                        <a href="#" class="page-text page-text--previous">前へ</a>
                    </div>
                    <div class="page-btn--next border_radius--small">
                        <a href="#" class="page-text page-text--next">次へ</a>
                    </div>
                    <div class="page-btn--last">
                        <a href="#" class="page-text page-text--last">最後へ</a>
                    </div>
                </div>
            </div>
            <!-- idを任意のものに変える -->
            <div id="oldres_content" class="tab__switching">
                <ul>
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <p class="contents__name contents__char-center">
                                    <?php echo "ハンドルネーム"; ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php echo "2022/01/01 10:22:16"; ?>
                                </div>
                            </div>
                            <div class="contents__bottom">
                                <div class="contents__detail contents__char-top">
                                    <?php echo "レス内容レス内容レス内容レス内容レス内容レス内容"; ?>
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
                    <li class="tab__contents">
                        <div class="contents__main">
                            <div class="contents__top">
                                <p class="contents__name contents__char-center">
                                    <?php echo "ハンドルネーム"; ?>
                                </p>
                                <div class="contents__datetime contents__char-center">
                                    <?php echo "2022/01/01 10:30:42"; ?>
                                </div>
                            </div>
                            <div class="contents__bottom">
                                <div class="contents__detail contents__char-top">
                                    <?php echo "レス内容レス内容レス内容レス内容レス内容レス内容"; ?>
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
                </ul>
                <div class="page-btn">
                    <div class="page-btn--first">
                        <a href="#" class="page-text page-text--first">最初へ</a>
                    </div>
                    <div class="page-btn--previous border_radius--small">
                        <a href="#" class="page-text page-text--previous">前へ</a>
                    </div>
                    <div class="page-btn--next border_radius--small">
                        <a href="#" class="page-text page-text--next">次へ</a>
                    </div>
                    <div class="page-btn--last">
                        <a href="#" class="page-text page-text--last">最後へ</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</main>
<?php $js_url = "js/threadDetail.js"; ?>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>