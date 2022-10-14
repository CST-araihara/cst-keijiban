<!-- headのタイトル -->
<?php $title = "研修掲示板スレッド作成ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/threadCreate.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<!-- IPアドレスブロック処理 -->
<?php include("components/blockprocess.php"); ?>
<main>
    <div class="threadCreate">
        <div class="title-position">
            <div class="pagetitle">
                <h2 class="Thread english-font font-size--20">Thread</h2>
            </div>
        </div>
        <form action="" class="create font-size--15">
            <div class="create__group">
                <label class="create__text" for="">タイトル</label>
                <textarea class="create__input create__input--title" name="" id="textarea"></textarea>
                <div class="create__group--bottom">
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                    </div>
                    <div class="count-text">
                        <div class="length">100</div>
                        <p>/100</p>
                    </div>
                </div>
            </div>
            <div class="create__group">
                <label class="create__text" for="">内容</label>
                <textarea class="create__input create__input--content" name="" id="textarea2"></textarea>
                <div class="create__group--bottom">
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                    </div>
                    <div class="count-text ">
                        <div class="length2">5000</div>
                        <p>/5000</p>
                    </div>
                </div>
            </div>
            <div class="create__group">
                <label class="create__text" for="">カテゴリ選択</label>
                <div class="create__input">
                    <select class="create__input--select" name="category" id="">
                        <option value="">カテゴリを選択</option>
                        <option value=""><?php echo "カテゴリ1";?></option>
                        <option value=""><?php echo "カテゴリ2";?></option>
                        <option value=""><?php echo "カテゴリ3";?></option>
                    </select>
                    <div class="error-message">
                        <i class="fa-solid fa-triangle-exclamation"></i><?php echo "選択してください"; ?>
                    </div>
                </div>
            </div>
            <div class="create__group--btn">
                <button class="btn btn--back" type="button" onclick="history.back();">前の画面に<br>戻る</button>
                <button class="btn btn--normal" type="button" onclick="location.href='categoryList.php'">作成する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/threadCreate.js"; ?>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>