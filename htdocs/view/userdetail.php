<!-- headのタイトル -->
<?php $title = "研修掲示板ユーザー詳細"; ?>
<!-- cssの適用 -->
<?php $url = "scss/userdetail.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
$icon = $_SESSION['friends_of_friends'][0];
$handlename = $_SESSION['friends_of_friends'][1];
$login_id = $_SESSION['friends_of_friends'][2];
$comment = $_SESSION['friends_of_friends'][3];
$count = $_SESSION['friends_of_friends'][4];
$id = $_SESSION['friends_of_friends'][5];
?>

<main>
    <div class="title-position">
        <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
        <div class="pagetitle">
            <h2 class="profile english-font font-size--20">Profile</h2>
        </div>
        <button class="btn btn--back none"></button>
    </div>
    <div class="profile-top">
        <div class="icon-position">
            <img class="icon border_radius--middle" src="<?php echo $icon; ?>" alt="">
        </div>
        <div class="name-position">
            <div class="name font-size--20">
                <div class="name__handlename"><p>HN</p>:<?php echo $handlename; ?></div>
            </div>
            <div class="friends font-size--15">
                <button class="btn btn--normal" type="button" onclick="location.href='../controller/dm_controller.php'">DM</button>
            </div>
        </div>
        <div class="comment-position">
            <div class="comment border_radius--middle font-size--15">
                <div class="comment__righttop english-font"><span>comment</span></div>
                <p class="comment__detail"><?php echo $comment; ?></p>
            </div>
        </div>
        <div class="btn-position">
            <button class="btn btn--normal none" type="button">友達申請する</button>
            <button class="btn btn--back none" type="button">申請を解除する</button>
            <button class="btn btn--back none" type="button">友達を解除する</button>
            <button class="btn btn--normal none" type="button">リクエストを許可する</button>
            <button class="btn btn--back" type="button">リクエストを拒否する</button>
            <button class="btn btn--back none" type="button">削除</button>
            <button class="btn btn--normal none" type="button">復元</button>
        </div>
    </div>
    <div class="profile-bottom">
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
                        <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
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