<!-- headのタイトル -->
<?php $title = "研修掲示板ユーザー一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/userslist.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
session_start();
$users = $_SESSION['users'];
?>

<main>
    <div class="title-position">
        <button class="btn btn--back" type="button" onclick="history.back();">戻る</button>
        <div class="pagetitle">
            <h2 class="userlist english-font font-size--20">UsersList</h2>
        </div>
        <button class="btn btn--back none"></button>
    </div>
    <div class="search-position">
        <form class="search" action="#" method="#">
            <input class="search__box" type="text" placeholder="キーワード入力">
            <button class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div class="tablearea font-size--15">
        <table id="filter">
            <thead>
                <tr class="th_tr">
                    <th class="sort">ID</th>
                    <th class="sort">ログインID</th>
                    <th class="sort">ハンドルネーム</th>
                    <th>名前（姓）</th>
                    <th>名前（名）</th>
                    <th class="sort">生年月日</th>
                    <th>詳細</th>
                    <th class="sort">削除</th>
                    <th class="sort">復元</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $row) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['login_id']; ?></td>
                    <td><?php echo $row['handlename']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><a class="black" href="userdetail.php">詳細</a></td>
                    <!-- 下2行はphpのissetで値があれば表示する -->
                    <td><a class="red" href="../controller/userslist_delete_controller.php?id=<?php echo $row['id'] ?>"><?php if ($row['delete_flag'] == 0) echo "削除"?></a></td>
                    <td><a class="blue" href="../controller/userslist_restoration_controller.php?id=<?php echo $row['id'] ?>"><?php if ($row['delete_flag'] == 1) echo "復元"?></a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<!-- jsの適用 -->
<?php $js_url = "js/userslist.js"; ?>
<!-- footer共通部分 -->
<?php include("components/footer.php"); ?>