<!-- headのタイトル -->
<?php $title = "研修掲示板アクセス履歴一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/accesshistorylist.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>

<main>
    <div class="title-position">
        <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
        <div class="pagetitle">
            <h2 class="access english-font font-size--20">AccessHistoryList</h2>
        </div>
        <button class="btn btn--back none"></button>
    </div>
    <div class="tablearea font-size--15">
        <table>
            <tbody>
                <tr>
                    <td class="id"><?php echo "1"; ?></td>
                    <td><?php echo "XXX.XXX.XXX.XXX"; ?></td>
                    <td><?php echo "2022/08/16 00:00:00"; ?></td>
                    <!-- 下2行はphpのissetで値が入っていたら表示する -->
                    <td><a class="red" href="#">ブロック</a></td>
                    <td><a class="blue" href="#"></a></td>
                </tr>
                <tr>
                    <td class="id">2</td>
                    <td>XXX.XXX.XXX.XXX</td>
                    <td>2022/08/17 00:00:00</td>
                    <td><a class="red" href="#">ブロック</a></td>
                    <td><a class="blue" href="#"></a></td>
                </tr>
                <tr>
                    <td class="id">3</td>
                    <td>XXX.XXX.XXX.XXX</td>
                    <td>2022/08/18 00:00:00</td>
                    <td><a class="red" href="#">ブロック</a></td>
                    <td><a class="blue" href="#"></a></td>
                </tr>
                <tr>
                    <td class="id">4</td>
                    <td>XXX.XXX.XXX.XXX</td>
                    <td>2022/08/19 00:00:00</td>
                    <td><a class="red" href="#"></a></td>
                    <td><a class="blue" href="#">解除</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("footer.php"); ?>
