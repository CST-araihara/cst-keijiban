<!-- headのタイトル -->
<?php $title = "研修掲示板ログインページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/login.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<main>
    <div class="login border_radius--middle" action="#">
        <div class="login__ribbon">
            <div class="login__title">
                <h2>ログイン</h2>
            </div>
        </div>
        <form class="login__form">
            <div class="login__group">
                <label class="login__text font-size--20">ID</label>
                <input class="login__input" type="text">
            </div>
            <div class="login__group">
                <label class="login__text font-size--20">PW</label>
                <input class="login__input "type="text">
            </div>
            <div class="error-message font-size--15 border_radius--small">
                <i class="fa-solid fa-triangle-exclamation"></i>IDかパスワードに誤りがあります
            </div>
            <div class="login__group">
            <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
            <button class="btn btn--normal" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>
