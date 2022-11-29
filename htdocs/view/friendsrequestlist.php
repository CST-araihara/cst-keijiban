<!-- headのタイトル -->
<?php $title = "研修掲示板友達リクエスト一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/friendsrequestlist.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$friendsrequest = $_SESSION['friendsrequest'];
?>

<main>
    <div class="back-position">
        <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
        <div></div>
        <div></div>
    </div>

    <div class="list border_radius--middle" action="#">
        <div class="list__ribbon">
            <div class="list__title">
                <h2>友達リクエスト一覧</h2>
            </div>
        </div>
        <div class="list__contents">
            <div class="send border_radius--middle">
                <p class="send__title font-size--20">送信したリクエスト</p>
                <?php
                foreach($friendsrequest as $row) {
                    if ($row['send_user_id'] == $_SESSION['login']) {
                ?>
                <div class="friends border_radius--middle">
                    <a href="../controller/userdetail_controller.php?friend_id=<?php echo $row['receive_user_id']; ?>" class="friends__h-name font-size--20"><?php echo $row['receive_user_name']; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--back" onclick="location.href='../controller/friendsrequestlist_controller.php?request_cancel=<?php echo $row['receive_user_id']; ?>'">申請解除</button>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="receive border_radius--middle">
                <p class="receive__title font-size--20">受信したリクエスト</p>
                <?php
                foreach($friendsrequest as $row) {
                    if ($row['receive_user_id'] == $_SESSION['login']) {
                ?>
                <div class="friends border_radius--middle">
                    <a href="../controller/userdetail_controller.php?friend_id=<?php echo $row['send_user_id']; ?>" class="friends__h-name font-size--20"><?php echo $row['send_user_name']; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--normal" onclick="location.href='../controller/friendsrequestlist_controller.php?permission=<?php echo $row['send_user_id']; ?>'">許可</button>
                        <button class="btn btn--back" onclick="location.href='../controller/friendsrequestlist_controller.php?rejection=<?php echo $row['send_user_id']; ?>'">拒否</button>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>


<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>