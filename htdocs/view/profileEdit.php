<!-- headのタイトル -->
<?php $title = "研修掲示板プロフィール編集ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/profileEdit.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$handlename = $_SESSION['handlename'];
$pw = $_SESSION['pw'];
$icon = $_SESSION['icon'];
$comment = $_SESSION['comment'];
?>

<main>
<div class="edit border_radius--middle">
        <div class="edit__ribbon">
            <div class="edit__title">
                <h2>プロフィール編集</h2>
            </div>
        </div>
        <form class="edit__form font-size--15" method="post" action="../controller/profileEdit_controller.php" enctype="multipart/form-data" novalidate>
            <table>
                <tr class="edit__group">
                    <th class="hissu">
                        <label class="edit__text font-size--20" for="">ハンドルネーム</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["edit"]['handlename'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["edit"]['handlename'][0].'</p>';
                            echo '<input name="handlename" class="edit__input" type="text" value="'.$_SESSION["edit"]['handlename'][1].'">';
                        }
                        elseif (!empty($_SESSION["edit"]['handlename'][1])) {
                            echo '<input name="handlename" class="edit__input" type="text" value="'.$_SESSION["edit"]['handlename'][1].'">';
                        }
                        else {
                            echo '<input name="handlename" class="edit__input" type="text" value="'.$handlename.'">';
                        }
                        ?>
                        <span class="edit__attention">20文字以内</span>
                    </td>
                </tr>
                <tr class="edit__group">
                    <th class="hissu">
                    <label class="edit__text font-size--20" for="">パスワード</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["edit"]['pw'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["edit"]['pw'][0].'</p>';
                            echo '<input name="password" class="edit__input" id="inputPassword" type="password" value="'.$_SESSION["edit"]['pw'][1].'">';
                        }
                        elseif (!empty($_SESSION["edit"]['pw'][1])) {
                            echo '<input name="password" class="edit__input" id="inputPassword" type="password" value="'.$_SESSION["edit"]['pw'][1].'">';
                        }
                        else {
                            echo '<input name="password" class="edit__input" id="inputPassword" type="password" value="'.$pw.'">';
                        }
                        ?>
                        <span class="edit__attention">半角英数8~16文字</span>
                        <label class="" for="inputCheckbox"><input id="inputCheckbox" type="checkbox">パスワードを表示する</label>
                    </td>
                </tr>
                <tr class="edit__group">
                    <th class="hissu">
                        <label  class="edit__text font-size--20" for="">パスワード（確認）</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["edit"]['pw_check'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["edit"]['pw_check'][0].'</p>';
                            echo '<input name="password_check" class="edit__input" id="reinputPassword" type="password" value="'.$_SESSION["edit"]['pw_check'][1].'">';
                        }
                        elseif (!empty($_SESSION["edit"]['pw_check'][1])) {
                            echo '<input name="password_check" class="edit__input" id="reinputPassword" type="password" value="'.$_SESSION["edit"]['pw_check'][1].'">';
                        }
                        else {
                            echo '<input name="password_check" class="edit__input" id="reinputPassword" type="password" value="'.$pw.'">';
                        }
                        ?>
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
                        <?php
                        if (!empty($_SESSION["edit"]['filename'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["edit"]['filename'][0].'</p>';
                        }
                        ?>
                        <label class="icon__label border_radius--middle" for="icon-img">
                            <span>選択<i class="fa-regular fa-image fa-fw"></i></span>
                            <input type="file" id="icon-img" name="image" class="icon__input" accept=".png,.jpg,.jpeg" onChange="imgPreview(event);">
                        </label>
                        <input class="img-reset__btn" type="button" value="Reset" onclick="resetPreview();">
                        <div id="preview">
                            <?php
                            if (!empty($_SESSION["edit"]['filename'][1])) {
                                echo '<img src="'.$_SESSION["edit"]["filename"][1].'" alt="">';
                            }
                            else {
                                echo '<img src="'.$icon.'" alt="">';
                            }
                            ?>
                        </div>
                        <?php
                        if (!empty($_SESSION["edit"]['filename'][1])) {
                            echo '<input id="hidden" name="hidden_img" type="hidden" value="'.$_SESSION["edit"]["filename"][1].'">';
                        }
                        else {
                            echo '<input id="hidden" name="hidden_img" type="hidden" value="'.$icon.'">';
                        }
                        ?>
                    </td>
                </tr>
                <tr class="edit__group">
                    <th class="ninni">
                        <label class="edit__text font-size--20" for="">ひとこと</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["edit"]['word'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["edit"]['word'][0].'</p>';
                            echo '<textarea name="word" class="edit__input" id="textarea" clos="30" rows="5">'.$_SESSION["edit"]['word'][1].'</textarea>';
                        }
                        elseif (!empty($_SESSION["edit"]['word'][1])) {
                            echo '<textarea name="word" class="edit__input" id="textarea" clos="30" rows="5">'.$_SESSION["edit"]['word'][1].'</textarea>';
                        }
                        else {
                            echo '<textarea name="word" class="edit__input" id="textarea" clos="30" rows="5">'.$comment.'</textarea>';
                        }
                        ?>
                        <div class="edit-info">
                            <span class="edit__attention "></span>
                            <div class="count-text ">
                            <div class="length"></div>
                            <p>/100</p>
                        </div>
                    </td>
                </tr>
            </table>
            <?php
            if (!empty($_SESSION["edit"]['handlename'][0]) || !empty($_SESSION["edit"]['pw'][0]) || !empty($_SESSION["edit"]['pw_check'][0]) ||!empty($_SESSION["edit"]['filename'][0]) || !empty($_SESSION["edit"]['word'][0])) {
                echo '<div id="error_total" class="error-message error-message__box border_radius--small">';
                echo '<i class="fa-solid fa-triangle-exclamation"></i>エラーがあります。確認してください。';
                echo '</div>';
            }
            ?>
            <div class="edit__group">
                <button name="back" class="btn btn--back" type="submit">戻る</button>
                <button class="btn btn--normal" type="submit">変更する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/profileEdit.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>