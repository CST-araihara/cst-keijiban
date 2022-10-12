<!-- headのタイトル -->
<?php $title = "研修掲示板管理者画面"; ?>
<!-- cssの適用 -->
<?php $url = "scss/adminpage.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
session_start();
$category = $_SESSION['category'];
$icon = $_SESSION['icon'];
?>

<main>
    <!-- 便宜上セッションを切るために置いたもの。後で消す -->
    <form action="karilogout.php" method="post">
        <input type="submit" value="セッションを切る">
    </form>
    <!-- 便宜上セッションを切るために置いたもの。後で消す -->
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
                <button class="btn btn--normal" type="button" onclick="location.href='accesshistorylist.php'">アクセス履歴</button>
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
</main>

<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>