<!-- headのタイトル -->
<?php $title = "研修掲示板友達リクエスト一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/friendsrequestlist.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<!-- IPアドレスブロック処理 -->
<?php include("components/blockprocess.php"); ?>

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
                <div class="friends border_radius--middle">
                    <a href="#" class="friends__h-name font-size--15"><?php echo "ハンドルネーム"; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--back">友達申請<br>解除</button>
                    </div>
                </div>
                <div class="friends border_radius--middle">
                    <a href="#" class="friends__h-name font-size--15"><?php echo "ハンドルネーム"; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--back">友達申請<br>解除</button>
                    </div>
                </div>
                <div class="friends border_radius--middle">
                    <a href="#" class="friends__h-name font-size--15"><?php echo "ハンドルネーム"; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--back">友達申請<br>解除</button>
                    </div>
                </div>
                <div class="friends border_radius--middle">
                    <a href="#" class="friends__h-name font-size--15"><?php echo "ハンドルネーム"; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--back">友達申請<br>解除</button>
                    </div>
                </div>
            </div>
            <div class="receive border_radius--middle">
                <p class="receive__title font-size--20">受信したリクエスト</p>
                <div class="friends border_radius--middle">
                    <a href="#" class="friends__h-name font-size--15"><?php echo "ハンドルネーム"; ?></a>
                    <div class="friends__btn">
                        <button class="btn btn--normal">友達登録</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- footer共通部分 -->
<?php include("footer.php"); ?>