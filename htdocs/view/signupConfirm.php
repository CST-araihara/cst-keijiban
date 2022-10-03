<!-- headのタイトル -->
<?php $title = "研修掲示板新規登録確認ページ"; ?>
<!-- cssの適用 -->
<?php $url = "scss/signupConfirm.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<main>
    <div class="signupConfirm border_radius--middle" action="#">
        <div class="signupConfirm__ribbon">
            <div class="signupConfirm__title">
                <h2>新規登録確認</h2>
            </div>
        </div>
        <form class="signupConfirm__form font-size--15">
            <table>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label class="signupConfirm__text font-size--20" for="">
                            ID<br>
                        </label>
                        <label class="signupConfirm__text" for="">
                            【登録後変更不可】
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "test123"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label class="signupConfirm__text font-size--20" for="">
                            パスワード
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "●●●●●●●●"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label  class="signupConfirm__text font-size--20" for="">
                            パスワード（確認）
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "●●●●●●●●"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label class="signupConfirm__text font-size--20" for="">
                            ハンドルネーム
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "ハンドルネーム"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label class="signupConfirm__text font-size--20" for="">
                            名前（姓）<br>
                        </label>
                        <label class="signupConfirm__text" for="">
                            【登録後変更不可】
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "山田"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label class="signupConfirm__text font-size--20" for="">
                            名前（名）<br>
                        </label>
                        <label class="signupConfirm__text" for="">
                            【登録後変更不可】
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "太郎"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="hissu">
                        <label class="signupConfirm__text font-size--20" for="">
                            生年月日<br>
                        </label>
                        <label class="signupConfirm__text" for="">
                            【登録後変更不可】
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "1990年1月1日"; ?>
                        </p>
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="ninni">
                        <label class="signupConfirm__text font-size--20" for="">
                            アイコン<br>
                        </label>
                        <label for="">
                            ※選択しない場合、<br>初期アイコンが設定されます
                        </label>
                    </th>
                    <td>
                        <img src="image/f_f_event_3_s128_f_event_3_2bg.png" class="signupConfirm__img border_radius--small">
                    </td>
                </tr>
                <tr class="signupConfirm__group">
                    <th class="ninni">
                        <label class="signupConfirm__text font-size--20" for="">
                            ひとこと
                        </label>
                    </th>
                    <td>
                        <p class="signupConfirm__input border_radius--small">
                            <?php echo "よろしくおねがいします！"; ?>
                        </p>
                    </td>
                </tr>
            </table>
            <div class="signupConfirm__group">
                <button class="btn btn--back" type="submit">
                    修正する
                </button>
                <button class="btn btn--normal" type="submit" onclick="location.href='mypage.php'">
                    登録して<br>ログイン
                </button>
            </div>
        </form>
    </div>
</main>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>
