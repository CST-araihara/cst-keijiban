<!-- headのタイトル -->
<?php $title = "研修掲示板DM"; ?>
<!-- cssの適用 -->
<?php $url = "scss/dm.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>
<!-- IPアドレスブロック処理 -->
<?php include("components/blockprocess.php"); ?>

<main>
    <div class="back-position">
        <button class="btn btn--back">戻る</button>
        <div></div>
        <div></div>
    </div>

    <div class="dm border_radius--middle" action="#">
        <div class="dm__ribbon">
            <div class="dm__title">
                <h2><?php echo "ハンドルネーム"; ?>さん</h2>
            </div>
        </div>
        <div class="dm__all">
            <div class="contents">
                <div class="icon-position">
                    <img class="icon" src="<?php echo "image/images.jpg"; ?>" alt="">
                </div>
                <div class="detail-position font-size--15">
                    <table>
                        <tbody>
                            <tr>
                                <td class="detail-position__receive"><p class="border_radius--middle"><?php echo "はじめまして！こんにちははじめまして！こんにちははじめまして！こんにちははじめまして！こんにちははじめまして！こんにちははじめまして！こんにちは"; ?></P></td>
                            </tr>
                            <tr>
                                <td class="detail-position__send"><p class="border_radius--middle"><?php echo "こんにちは。よろしくお願いします。"; ?></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="send-position">
                <input class="send-position__message" type="text" placeholder="メッセージを入力">
                <button class="btn btn--normal" type="button">送信</button>
            </div>
        </div>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("footer.php"); ?>