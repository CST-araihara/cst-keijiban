<!-- headのタイトル -->
<?php $title = "研修掲示板アクセス履歴一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/accesshistorylist.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if ($_SESSION['role'] != 1) {
    header("Location: index.php");
    exit;
}
$ip = $_SESSION['ip'];
?>

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
                <?php
                foreach ($ip as $row) {
                ?>
                <tr>
                    <td class="id"><?php echo $row['id']; ?></td>
                    <td><?php echo $row['ip_address']; ?></td>
                    <td><?php echo $row['inserted_date']; ?></td>
                    <!-- 下2行はphpのissetで値が入っていたら表示する -->
                    <td><a class="red" href="../controller/accesshistorylist_controller.php?id=<?php echo $row['id'] ?>.&judge=block"><?php if ($row['block_flag'] == 0) echo "ブロック"?></a></td>
                    <td><a class="blue" href="../controller/accesshistorylist_controller.php?id=<?php echo $row['id'] ?>"><?php if ($row['block_flag'] == 1) echo "解除"?></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>
