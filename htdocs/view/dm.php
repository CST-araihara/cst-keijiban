<!-- headのタイトル -->
<?php $title = "研修掲示板DM"; ?>
<!-- cssの適用 -->
<?php $url = "scss/dm.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$icon = $_SESSION['friends_of_friends'][0];
$handlename = $_SESSION['friends_of_friends'][1];
$messages = $_SESSION['DM'];
?>

<main>
    <div class="back-position">
        <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
        <div></div>
        <div></div>
    </div>
    <div class="dm border_radius--middle">
        <div class="dm__ribbon">
            <div class="dm__title">
                <h2><?php echo $handlename; ?>さん</h2>
            </div>
        </div>
        <div class="dm__all font-size--15">
            <div class="contents">
                <div class="detail-position">
                    <?php
                    foreach($messages as $row) {
                        if ($row['send_user_id'] != $_SESSION['login']) {
                            echo '<div class="detail-position__receive"><img class="icon icon-position" src="'.$icon.'" alt=""><p class="border_radius--middle">'.$row['message'].'</P></div>';
                            echo '<div class="detail-position__receivetime">'.$row['datetime'].'</div>';
                        }
                        else {
                            echo '<div class="detail-position__send"><p class="border_radius--middle">'.$row['message'].'</P></div>';
                            echo '<div class="detail-position__sendtime">'.$row['datetime'].'</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <form method="post" action="../controller/dm_controller.php" class="validationForm" novalidate>
                <div class="send-position">
                    <div class="send-position__messages">
                        <div id="error"><i class="fa-solid fa-triangle-exclamation"></i>100文字以内で入力してください</div>
                        <textarea id="textarea" name="dm_message" class="text maxlength" data-maxlength="100" placeholder="メッセージを入力"></textarea>
                    </div>
                    <div class="send-position__btn-count">
                        <button class="btn btn--normal" type="submit">送信</button>
                        <div class="count-text">
                            <div class="length">100</div>
                            <p>/100</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- cssの適用 -->
<?php $js_url = "js/dm.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>