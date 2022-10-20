<!-- headのタイトル -->
<?php $title = "研修掲示板友達一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/friendslist.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>

<main>
    <div class="back-position">
        <button class="btn btn--back" type="button"  onclick="history.back();">戻る</button>
        <div></div>
        <div></div>
    </div>

    <div class="list border_radius--middle" action="#">
        <div class="list__ribbon">
            <div class="list__title">
                <h2>友達一覧</h2>
            </div>
        </div>
        <div class="list__contents">
            <div class="friends border_radius--middle">
                <a href="#" class="friends__h-name font-size--20"><?php echo "ハンドルネーム"; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal" type="button">DM</button>
                    <button class="btn btn--back">友達<br>解除</button>
                </div>
            </div>
            <div class="friends border_radius--middle">
                <a href="#" class="friends__h-name font-size--20"><?php echo "ハンドルネーム"; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal">DM</button>
                    <button class="btn btn--back">友達<br>解除</button>
                </div>
            </div>
            <div class="friends border_radius--middle">
                <a href="#" class="friends__h-name font-size--20"><?php echo "ハンドルネーム"; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal">DM</button>
                    <button class="btn btn--back">友達<br>解除</button>
                </div>
            </div>
            <div class="friends border_radius--middle">
                <a href="#" class="friends__h-name font-size--20"><?php echo "ハンドルネーム"; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal">DM</button>
                    <button class="btn btn--back">友達<br>解除</button>
                </div>
            </div>
            <div class="friends border_radius--middle">
                <a href="#" class="friends__h-name font-size--20"><?php echo "ハンドルネーム"; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal">DM</button>
                    <button class="btn btn--back">友達<br>解除</button>
                </div>
            </div>
            <div class="friends border_radius--middle">
                <a href="#" class="friends__h-name font-size--20"><?php echo "ハンドルネーム"; ?></a>
                <div class="friends__btn">
                    <button class="btn btn--normal">DM</button>
                    <button class="btn btn--back">友達<br>解除</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("footer.php"); ?>