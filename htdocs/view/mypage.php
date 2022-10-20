<!-- headのタイトル -->
<?php $title = "研修掲示板マイページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/mypage.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$handlename = $_SESSION['handlename'];
$login_id = $_SESSION['login_id'];
$icon = $_SESSION['icon'];
?>

<main>
    <div class="filter"></div>
    <div class="title-position">
        <div class="pagetitle">
            <h2 class="mypage english-font font-size--20">MyPage</h2>
        </div>
    </div>
    <div class="mypage-top">
        <div class="icon-position">
            <img class="icon border_radius--middle" src="<?php echo $icon; ?>" alt="">
        </div>
        <div class="name-position">
            <div class="name font-size--20">
                <div class="name__handlename"><p>HN</p>:<?php echo $handlename ?></div>
                <div class="name__id"><p>ID</p>:<?php echo $login_id  ?></div>
            </div>
            <div class="friends font-size--15">
                <!-- 友達の人数は計算して出す -->
                <a class="friends__people" href="friendslist.php">友達:<?php echo "0"; ?>人</a>
                <a class="friends__request" href="friendsrequestlist.php">友達リクエスト</a>
            </div>
        </div>
        <div class="comment-position">
            <div class="comment border_radius--middle font-size--15">
                <div class="comment__righttop english-font"><span>comment</span></div>
                <p class="comment__detail"><?php echo "コメント"; ?></p>
            </div>
        </div>
        <div class="btn-position">
            <button class="btn btn--normal" type="button"onclick="location.href='profileEdit.php'">プロフィールを編集する</button>
        </div>
    </div>
    <div class="mypage-bottom">
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

<!-- jsの適用 -->
<?php $js_url = "js/good.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>