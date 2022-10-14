<!-- headのタイトル -->
<?php $title = "研修掲示板プロフィール編集ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/profileEdit.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<!-- IPアドレスブロック処理 -->
<?php include("components/blockprocess.php"); ?>

<main>
<div class="edit border_radius--middle" action="#">
        <div class="edit__ribbon">
            <div class="edit__title">
                <h2>プロフィール編集</h2>
            </div>
        </div>
        <form class="edit__form font-size--15">
            <table>
                <tr class="edit__group">
                    <th class="hissu">
                        <label class="edit__text font-size--20" for="">ハンドルネーム</label>
                    </th>
                    <td>
                        <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?></div>
                        <input class="edit__input" type="text" value=<?php echo "ハンドルネーム"; ?> required>
                        <span class="edit__attention">半角英数20文字以内</span>
                    </td>
                </tr>
                <tr class="edit__group">
                    <th class="hissu">
                    <label class="edit__text font-size--20" for="">パスワード</label>
                    </th>
                    <td>
                        <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?></div>
                        <input class="edit__input" id="inputPassword" type="password" value=<?php echo "password"; ?> required>
                        <span class="edit__attention">半角英数8~16文字</span>
                        <label class="" for="inputCheckbox"><input id="inputCheckbox" type="checkbox">パスワードを表示する</label>
                    </td>
                </tr>
                <tr class="edit__group">
                    <th class="hissu">
                        <label  class="edit__text font-size--20" for="">パスワード（確認）</label>
                    </th>
                    <td>
                        <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?></div>
                        <input class="edit__input" id="reinputPassword" type="password" value=<?php echo "password"; ?> required>
                        <span class="edit__attention">半角英数8~16文字</span>
                        <label class="" for="reinputCheckbox"><input id="reinputCheckbox" type="checkbox">パスワードを表示する</label>
                    </td>
                </tr>
                
                <tr class="edit__group">
                    <th class="ninni">
                        <label class="edit__text font-size--20" for="">アイコン<br></label>
                        <label class="" for="">※選択しない場合、<br>初期アイコンが設定されます</label>
                    </th>
                    <td>
                        <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?></div>
                        <label class="icon__label border_radius--middle" for="icon-img">
                            <span>選択<i class="fa-regular fa-image fa-fw"></i></span>
                            <input type="file" id="icon-img" class="icon__input " accept=".png,.jpg,.jpeg,.pdf,.doc">
                        </label>
                        <input class="img-reset__btn" type="reset" value="Reset" onclick="resetPreview();">
                        <div id="preview"></div>
                    </td>
                </tr>
                <tr class="edit__group">
                    <th class="ninni">
                        <label class="edit__text font-size--20" for="">ひとこと</label>
                    </th>
                    <td>
                        <div class="error-message"><i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?></div>
                        <textarea class="edit__input" id="textarea" clos="30" rows="5"><?php echo "よろしくお願いします！！！"; ?></textarea>
                        <div class="edit-info">
                            <span class="edit__attention "></span>
                            <div class="count-text ">
                            <div class="length"></div>
                            <p>/100</p>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="edit__group">
                <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
                <button class="btn btn--normal" type="submit">変更する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/profileEdit.js"; ?>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>