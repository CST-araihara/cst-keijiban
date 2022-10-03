<!-- headのタイトル -->
<?php $title = "研修掲示板管理者画面"; ?>
<!-- cssの適用 -->
<?php $url = "scss/adminpage.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>

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
                    <img class="icon border_radius--middle" src="<?php echo "image/images.jpg"; ?>" alt="">
                </div>
                <div class="name-position">
                    <div class="name font-size--20">
                        <div class="name__handlename"><p>HN</p>:管理者</div>
                        <div class="name__id"><p>ID</p>:admin0000</div>
                    </div>
                </div>
            </div>
            <div class="btn-position">
                <button class="btn btn--normal" type="button" onclick="location.href='top.php'">トップページを表示する</button>
                <button class="btn btn--normal" type="button" onclick="location.href='userslist.php'">ユーザー一覧</button>
                <button class="btn btn--normal" type="button" onclick="location.href='accesshistorylist.php'">アクセス履歴</button>
            </div>
        </div>
        <div class="page-right">
            <div class="search-position">
                <form class="search" action="#" method="#">
                    <input class="search__box" type="text" size="10" placeholder="キーワード入力">
                    <button class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="category-position">
                <li><button class="btn btn--normal" type="button"><?php echo "カテゴリ1"; ?></button></li>
                <li><button class="btn btn--normal" type="button"><?php echo "カテゴリ2"; ?></button></li>
                <li><button class="btn btn--normal" type="button"><?php echo "カテゴリ3"; ?></button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ4</button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ5</button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ6</button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ7</button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ8</button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ9</button></li>
                <li><button class="btn btn--normal" type="button">カテゴリ10</button></li>
            </div>
        </div>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("footer.php"); ?>