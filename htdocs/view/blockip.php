<!-- headのタイトル -->
<?php $title = "研修掲示板IPアドレスブロック"; ?>
<!-- cssの適用 -->
<?php $url = "scss/blockip.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<main>
    <div class="blockip border_radius--middle" action="#">
        <div class="blockip__ribbon">
            <div class="blockip__title">
                <h2>IPアドレスブロック</h2>
            </div>
        </div>
        <i class="fa-solid fa-user-slash fa-5x"></i>
        <p class="blockip__mes">お使いのIPアドレスは<br>サイト運営者によりブロックされています。</p>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>