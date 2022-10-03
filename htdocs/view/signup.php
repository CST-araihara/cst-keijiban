<!-- headのタイトル -->
<?php $title = "研修掲示板新規登録ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/signup.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<main>
    <div class="signup border_radius--middle" action="#">
        <div class="signup__ribbon">
            <div class="signup__title">
                <h2>新規登録</h2>
            </div>
        </div>
        <form class="signup__form font-size--15">
            <table>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">ID<br></label>
                        <label class="signup__text " for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <div class="error-message ">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <input class="signup__input" type="text" required>
                        <span class="signup__attention ">半角英数10文字以内</span>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                    <label class="signup__text font-size--20" for="">パスワード</label>
                    </th>
                    <td>
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <input class="signup__input" id="inputPassword" type="password" required>
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
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <input class="signup__input" id="reinputPassword" type="password" required>
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
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <input class="signup__input" type="text" required>
                        <span class="signup__attention">半角英数20文字以内</span>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">名前（姓）<br></label>
                        <label class="signup__text " for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <input class="signup__input" type="text" required>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">名前（名）<br></label>
                        <label class="signup__text" for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <input class="signup__input" type="text" required>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="hissu">
                        <label class="signup__text font-size--20" for="">生年月日<br></label>
                        <label class="signup__text " for="">【登録後変更不可】</label>
                    </th>
                    <td>
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <select name="year" class="signup__select signup__select--long signup__input">
                            <option value="">-</option>
                            <?php 
                                for($i=1922;$i<=2022;$i++){
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                            ?>
                        </select>
                        <span class="">年</span>
                        <select name="month" class="signup__select signup__select--short signup__input">
                            <option value="">-</option>
                            <?php 
                                for($i=1;$i<=12;$i++){
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                            ?>
                        </select>
                        <span class="">月</span>
                        <select name="day" class="signup__select signup__select--short signup__input">
                            <option value="">-</option>
                            <?php 
                                for($i=1;$i<=31;$i++){
                                    echo '<option value='.$i.'>'.$i.'</option>';
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
                        <div class="error-message ">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <label class="icon__label border_radius--middle" for="icon-img">
                            <span class="">選択<i class="fa-regular fa-image fa-fw"></i></span>
                            <input type="file" id="icon-img" class="icon__input" accept=".png,.jpg,.jpeg">
                        </label>
                        <input class="img-reset__btn" type="reset" value="Reset" onclick="resetPreview();">
                        <div id="preview"></div>
                    </td>
                </tr>
                <tr class="signup__group">
                    <th class="ninni">
                        <label class="signup__text font-size--20" for="">ひとこと</label>
                    </th>
                    <td>
                        <div class="error-message">
                            <i class="fa-solid fa-triangle-exclamation"></i><?php echo "エラーメッセージ"; ?>
                        </div>
                        <textarea class="signup__input" id="textarea" clos="30" rows="5"></textarea>
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
            <div class="error-message error-message__box border_radius--small">
                <i class="fa-solid fa-triangle-exclamation"></i><?php echo"**"; ?>件のエラーがあります。確認してください。
            </div>
            <div class="signup__group">
                <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
                <button class="btn btn--normal" type="submit">確認する</button>
            </div>
        </form>
    </div>
</main>
<?php $js_url = "js/signup.js"; ?>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>