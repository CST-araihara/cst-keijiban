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
    <div class="search-position font-size--15">
        <form class="search" action="#" method="#">
            <input class="search__box" type="text" placeholder="キーワード入力">
            <button class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <div class="search__condition">
                <div class="conditions">
                    <div>
                        <input name="type1" id="user_check" value="" type="radio" checked><label class="space" for="user_check">ハンドルネーム</label>
                    </div>
                    <div>
                        <input name="type1" id="keyword_check" value="" type="radio"><label class="space" for="keyword_check">キーワード</label>
                    </div>
                    <div>
                        <input name="type1" id="user_key_check" value="" type="radio"><label class="space" for="user_key_check">ハンドルネームとキーワード</label>
                    </div>
                </div>
                <div class="char-center">で</div>
                <div class="conditions">
                    <div>
                        <input name="type2" id="thread_check" value="" type="radio" checked><label for="thread_check">スレッド</label>
                    </div>
                    <div>
                        <input name="type2" id="res_check" value="" type="radio"><label for="res_check">レス</label>
                    </div>
                    <div>
                        <input name="type2" id="thread_res_check" value="" type="radio"><label for="thread_res_check">スレッドとレス</label>
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