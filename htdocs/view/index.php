<!-- headのタイトル -->
<?php $title = "研修掲示板トップページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/top.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
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
            <input id="new_threadtab" type="radio" name="tab_item" checked>
            <label class="tab_item" for="new_threadtab">最近作成されたスレッド</label>
            <input id="many_responsetab" type="radio" name="tab_item">
            <label class="tab_item" for="many_responsetab">レスの多い順</label>
            <input id="many_goodtab" type="radio" name="tab_item">
            <label class="tab_item" for="many_goodtab">いいねの多い順</label>
            <!-- idを任意のものに変える -->
            <ul id="thread_content" class="tab__switching">
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon">
                                <?php echo "カテゴリ"; ?>
                            </div>
                            <p class="contents__title contents__char-center">
                                <?php echo "最近作成されたタイトル"; ?>
                            </p>
                            <div class="contents__datetime contents__char-center">
                                <?php echo "時間 / HN / レス数（XX）"; ?>
                            </div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top">
                                <?php echo "スレッド内容スレッド内容"; ?>
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
                            <div class="contents__ribbon">
                                <?php echo "カテゴリ"; ?>
                            </div>
                            <p class="contents__title contents__char-center">
                                <?php echo "最近作成されたタイトル"; ?>
                            </p>
                            <div class="contents__datetime contents__char-center">
                                <?php echo "時間 / HN / レス数（XX）"; ?>
                            </div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top">
                                <?php echo "スレッド内容スレッド内容"; ?>
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
            <!-- idを任意のものに変える -->
            <ul id="response_content" class="tab__switching">
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon">
                                <?php echo "カテゴリ"; ?>
                            </div>
                            <p class="contents__title contents__char-center">
                                <?php echo "レス数の多いタイトル"; ?>
                            </p>
                            <div class="contents__datetime contents__char-center">
                                <?php echo "時間 / HN / レス数（XX）"; ?>
                            </div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top">
                                <?php echo "スレッド内容スレッド内容"; ?>
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
                            <div class="contents__ribbon">
                                <?php echo "カテゴリ"; ?>
                            </div>
                            <p class="contents__title contents__char-center">
                                <?php echo "レス数の多いタイトル"; ?>
                            </p>
                            <div class="contents__datetime contents__char-center">
                                <?php echo "時間 / HN / レス数（XX）"; ?>
                            </div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top">
                                <?php echo "スレッド内容スレッド内容"; ?>
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
            <!-- idを任意のものに変える -->
            <ul id="good_content" class="tab__switching">
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon">
                                <?php echo "カテゴリ"; ?>
                            </div>
                            <p class="contents__title contents__char-center">
                                <?php echo "いいねの多いタイトル"; ?>
                            </p>
                            <div class="contents__datetime contents__char-center">
                                <?php echo "時間 / HN / いいね数（XX）"; ?>
                            </div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top">
                                <?php echo "スレッド内容スレッド内容"; ?>
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
                            <div class="contents__ribbon">
                                <?php echo "カテゴリ"; ?>
                            </div>
                            <p class="contents__title contents__char-center ">
                                <?php echo "いいねの多いタイトル"; ?>
                            </p>
                            <div class="contents__datetime contents__char-center ">
                                <?php echo "時間 / HN / いいね数（XX）"; ?>
                            </div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top">
                                <?php echo "スレッド内容スレッド内容"; ?>
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
        </div>
    </div>
</main>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>
