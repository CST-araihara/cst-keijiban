<!-- headのタイトル -->
<?php $title = "研修掲示板友達一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/friendslist.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$friends = $_SESSION['friends'];
?>

<main>
    <div class="back-position">
        <button class="btn btn--back" type="button" onclick="location.href ='../controller/mypage_controller.php'">戻る</button>
        <div></div>
        <div></div>
    </div>

    <div class="list border_radius--middle">
        <div class="list__ribbon">
            <div class="list__title">
                <h2>友達一覧</h2>
            </div>
        </div>
        <div class="list__contents">
            <?php
            foreach($friends as $row) {
            ?>
            <div class="friends border_radius--middle">
                <a href="../controller/userdetail_controller.php?friend_id=<?php echo $row['your_user_id']; ?>" class="friends__h-name font-size--20"><?php echo $row['handlename']; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal" type="button" onclick="location.href='dm.php'">DM</button>
                    <button class="btn btn--back" onclick="location.href='../controller/friendslist_controller.php?delete=<?php echo $row['your_user_id']; ?>'">友達<br>解除</button>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>