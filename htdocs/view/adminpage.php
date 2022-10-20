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

$category = $_SESSION['category'];
$icon = $_SESSION['icon'];
?>

<main>
    <div class="title-position">
        <div class="pagetitle">
            <h2 class="admin english-font font-size--20">AdminPage</h2>
        </div>
    </div>
    <div class="page-all">
        <div class="page-left">
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
                <button class="btn btn--normal" type="button" onclick="location.href='index.php'">トップページを表示する</button>
                <button class="btn btn--normal" type="button" onclick="location.href='../controller/userslist_controller.php'">ユーザー一覧</button>
                <button class="btn btn--normal" type="button" onclick="location.href='../controller/accesshistorylist_controller.php'">アクセス履歴</button>
            </div>
        </div>
        <div class="page-right">
            <div class="search-position">
                <form class="search" action="../controller/adminpage_controller.php" method="post">
                    <input class="search__box" type="text" name="key_search" size="10" placeholder="キーワード入力">
                    <button class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="category-position">
                <?php
                foreach($category as $row) {
                ?>
                <li><button class="btn btn--normal" type="button"><?php echo $row['category_name']; ?></button></li>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="adminpage-bottom">
        <div class="tab font-size--15">
            <!-- inputのidとlabelのforが対になる -->
            <input id="new_threadtab" type="radio" name="tab_item" checked>
                <label class="tab_item" for="new_threadtab">最近作成したスレッド</label>
            <input id="new_responsetab" type="radio" name="tab_item">
                <label class="tab_item" for="new_responsetab">最近のレス</label>
            <input id="goodtab" type="radio" name="tab_item">
                <label class="tab_item" for="goodtab">いいね</label>
            <!-- idを任意のものに変える -->
            <ul id="thread_content" class="tab__switching">
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "スレッド内容スレッド内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <!-- <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div> -->
                        <div class="contents__good">いいね<i id="star" class="fa-regular fa-star"></i></div>
                    </div>
                </li>
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "スレッド内容スレッド内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <!-- <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div> -->
                        <div class="contents__good">いいね<i id="star" class="fa-regular fa-star"></i></div>
                    </div>
                </li>
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "スレッド内容スレッド内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
            </ul>
            <!-- idを任意のものに変える -->
            <ul id="response_content" class="tab__switching">
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / <?php echo "HN"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "レス内容レス内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / <?php echo "HN"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "レス内容レス内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / <?php echo "HN"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "レス内容レス内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
            </ul>
            <!-- idを任意のものに変える -->
            <ul id="good_content" class="tab__switching">
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "スレッド内容スレッド内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / <?php echo "HN"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "レス内容レス内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
                <li class="tab__contents">
                    <div class="contents__main">
                        <div class="contents__top">
                            <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                            <p class="contents__title contents__char-center"><?php echo "タイトルタイトルタイトル"; ?></p>
                            <div class="contents__datetime contents__char-center"><?php echo "時間"; ?> / <?php echo "HN"; ?> / レス数（<?php echo "XX"; ?>）</div>
                        </div>
                        <div class="contents__bottom">
                            <div class="contents__detail contents__char-top"><?php echo "レス内容レス内容"; ?></div>
                        </div>
                    </div>
                    <div class="contents__sub">
                        <!-- phpのissetで表示非表示切り替え&ユーザーと管理者でも切替 -->
                        <div class="contents__admin">
                            <div class="contents__delete"><a href="#">削除</a></div>
                            <div class="contents__recover"><a href="#">復元</a></div>
                        </div>
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>