<!-- headのタイトル -->
<?php $title = "研修掲示板レス投稿ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/response.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<!-- IPアドレスブロック処理 -->
<?php include("components/blockprocess.php"); ?>

<main>
    <div class="response font-size--15">
        <div class="title-position">
            <div class="pagetitle">
                <h2 class="response-title english-font font-size--20">Response</h2>
            </div>
        </div>
        <div class="thread">
            <div class="contents__main">
                <div class="contents__top">
                    <div class="contents__ribbon"><?php echo "カテゴリ"; ?></div>
                    <p class="contents__title contents__char-center"><?php echo "タイトル"; ?></p>
                    <div class="contents__datetime contents__char-center"><?php echo "2022/01/01 10:15:30"; ?></div>
                </div>
                <div class="contents__middle contents__char-top"><?php echo "ハンドルネーム"; ?></div>
                <div class="contents__bottom">
                    <div class="contents__detail contents__char-top"><?php echo "スレッド内容スレッド内容スレッド内容スレッド内容"; ?></div>
                </div>
            </div>
            <div class="contents__sub">
                <div class="contents__admin">
                    <div class="contents__delete"><a href="#">削除</a></div>
                    <div class="contents__recover"><a href="#">復元</a></div>
                </div>
                <div class="contents__good">いいね<i class="fa-regular fa-star"></i></div>
            </div>
        </div>
        <form class="response-form" action="">
            <textarea class="response-form__input" placeholder="内容を入力してください" name="" id="textarea" cols="30" rows="10"></textarea>
            <div class="response-form__info">
                <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php echo "文字数オーバーです"; ?></div>
                <div class="count-text">
                    <div class="length">5000</div>
                    <p>/5000</p>
                </div>
            </div>
        </form>
        <div class="response__btn">
            <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
            <button class="btn btn--normal">送信する</button>
        </div>
        
    </div>
</main>
<?php $js_url = "js/response.js"; ?>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>