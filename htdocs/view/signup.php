<!-- headのタイトル -->
<?php $title = "研修掲示板新規登録ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/signup.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<main>
    <!-- セッション切断仮置き -->
    <!-- <form action="../controller/logout_controller.php">
        <input type="submit" value="セッション切断">
    </form> -->
    <!-- セッション切断置き -->
    <div class="signup border_radius--middle" action="#">
        <div class="signup__ribbon">
            <div class="signup__title">
                <h2>新規登録</h2>
            </div>
        </div>
        <form action="../controller/signup_controller.php" method="post" enctype="multipart/form-data" class="signup__form font-size--15 validationForm" novalidate>
            <table>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">ID<br></label>
                        <label class="signup__text " for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['id'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['id'][0].'</p>';
                        }
                        ?>
                        <input name="login_id" class="signup__input" data-maxlength="10" type="text" value="<?php if(!empty($_SESSION["signup"]['id'][1])) { echo $_SESSION["signup"]['id'][1]; }; ?>">
                        <span class="signup__attention">半角英数10文字以内</span>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                    <label class="signup__text font-size--20" for="">パスワード</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['pw'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['pw'][0].'</p>';
                        }
                        ?>
                        <input name="password" class="signup__input" id="inputPassword" type="password" value="<?php if(!empty($_SESSION["signup"]['pw'][1])) { echo $_SESSION["signup"]['pw'][1]; }; ?>">
                        <span class="signup__attention">半角英数8~16文字</span>
                        <label class="" for="inputCheckbox">
                            <input id="inputCheckbox" type="checkbox">パスワードを表示する
                        </label>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label  class="signup__text font-size--20" for="">パスワード（確認）</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['pw_check'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['pw_check'][0].'</p>';
                        }
                        ?>
                        <input name="password_check" class="signup__input" id="reinputPassword" type="password" value="<?php if(!empty($_SESSION["signup"]['pw_check'][1])) { echo $_SESSION["signup"]['pw_check'][1]; }; ?>">
                        <span class="signup__attention">半角英数8~16文字</span>
                        <label class="" for="reinputCheckbox">
                            <input id="reinputCheckbox" type="checkbox">パスワードを表示する
                        </label>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">ハンドルネーム</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['handlename'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['handlename'][0].'</p>';
                        }
                        ?>
                        <input name="handlename" class="signup__input" type="text" value="<?php if(!empty($_SESSION["signup"]['handlename'][1])) { echo $_SESSION["signup"]['handlename'][1]; }; ?>">
                        <span class="signup__attention">20文字以内</span>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">名前（姓）<br></label>
                        <label class="signup__text" for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['l_name'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['l_name'][0].'</p>';
                        }
                        ?>
                        <input name="l_name" class="signup__input" type="text" value="<?php if(!empty($_SESSION["signup"]['l_name'][1])) { echo $_SESSION["signup"]['l_name'][1]; }; ?>">
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">名前（名）<br></label>
                        <label class="signup__text" for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['f_name'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['f_name'][0].'</p>';
                        }
                        ?>
                        <input  name="f_name" class="signup__input" type="text" value="<?php if(!empty($_SESSION["signup"]['f_name'][1])) { echo $_SESSION["signup"]['f_name'][1]; }; ?>">
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">生年月日<br></label>
                        <label class="signup__text " for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['dob'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['dob'][0].'</p>';
                        }
                        ?>
                        <select name="year" class="signup__select signup__select--long signup__input">
                            <option value="">-</option>
                            <?php
                            for ($i=1922;$i<=2022;$i++) {
                                if (empty($_SESSION["signup"]['dob'][1])) {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                                elseif ($i == $_SESSION['signup']['dob'][1]) {
                                    echo '<option value='.$i.' selected>'.$i.'</option>';
                                }
                                else {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="">年</span>
                        <select name="month" class="signup__select signup__select--short signup__input">
                            <option value="">-</option>
                            <?php
                            for ($i=1;$i<=12;$i++) {
                                if (empty($_SESSION["signup"]['dob'][2])) {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                                elseif ($i == $_SESSION['signup']['dob'][2]) {
                                    echo '<option value='.$i.' selected>'.$i.'</option>';
                                }
                                else {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="">月</span>
                        <select name="day" class="signup__select signup__select--short signup__input">
                            <option value="">-</option>
                            <?php
                            for ($i=1;$i<=31;$i++) {
                                if (empty($_SESSION["signup"]['dob'][3])) {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                                elseif ($i == $_SESSION['signup']['dob'][3]) {
                                    echo '<option value='.$i.' selected>'.$i.'</option>';
                                }
                                else {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                            }
                            ?>
                        </select>
                        <span class="">日</span>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="ninni">
                        <label class="signup__text font-size--20" for="">アイコン<br></label>
                        <label class="" for="">※選択しない場合、<br>初期アイコンが設定されます</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['filename'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['filename'][0].'</p>';
                        }
                        ?>
                        <label class="icon__label border_radius--middle" for="icon-img">
                            <span class="">選択<i class="fa-regular fa-image fa-fw"></i></span>
                            <input type="file" id="icon-img" name="image" class="icon__input" accept=".png,.jpg,.jpeg" onChange="imgPreview(event);">
                        </label>
                        <input class="img-reset__btn" type="button" value="Reset" onclick="resetPreview();">
                        <div id="preview"></div>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="ninni">
                        <label class="signup__text font-size--20" for="">ひとこと</label>
                    </th>
                    <td>
                        <?php
                        if (!empty($_SESSION["signup"]['word'][0])) {
                            echo '<p class="error-message"><i class="fa-solid fa-triangle-exclamation"></i>'.$_SESSION["signup"]['word'][0].'</p>';
                        }
                        ?>
                        <textarea class="signup__input maxlength" id="textarea" name="word" clos="30" rows="5"><?php if(!empty($_SESSION["signup"]['word'][1])) { echo $_SESSION["signup"]['word'][1]; }; ?></textarea>
                        <div class="signup-info">
                            <span class="signup__attention"></span>
                            <div class="count-text">
                                <div class="length">100</div>
                                <p>/100</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <?php
            if (!empty($_SESSION["signup"]['id'][0]) || !empty($_SESSION["signup"]['pw'][0]) || !empty($_SESSION["signup"]['pw_check'][0]) || !empty($_SESSION["signup"]['handlename'][0]) || !empty($_SESSION["signup"]['l_name'][0]) || !empty($_SESSION["signup"]['f_name'][0]) || !empty($_SESSION["signup"]['dob'][0]) || !empty($_SESSION["signup"]['filename'][0]) || !empty($_SESSION["signup"]['word'][0])) {
                echo '<div id="error_total" class="error-message error-message__box border_radius--small">';
                echo '<i class="fa-solid fa-triangle-exclamation"></i>エラーがあります。確認してください。';
                echo '</div>';
            }
            ?>
            <div class="signup__group">
                <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
                <button class="btn btn--normal" type="submit">確認する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/signup.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>