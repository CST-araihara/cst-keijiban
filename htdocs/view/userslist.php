<!-- headのタイトル -->
<?php $title = "研修掲示板ユーザー一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/userslist.css"; ?>
<!-- header共通部分 -->
<?php include("components/header.php"); ?>

<?php
if ($_SESSION['role'] != 1) {
    header("Location: index.php");
    exit;
}
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
    <div class="search-position font-size--15">
        <!-- <form class="search" action="../controller/userslist_controller.php" method="post">
            <table class="search__condition1">
                <tbody>
                    <tr>
                        <th><label>ID</label></th>
                        <td><input name="id" class="input" type="text"></td>
                        <th><label>ログインID</label></th>
                        <td><input name="login_id" class="input" type="text"></td>
                        <th><label>ハンドルネーム</label></th>
                        <td><input name="handlename" class="input" type="text"></td>
                    </tr>
                    <tr>
                        <th><label>名前（姓）</label></th>
                        <td><input name="l_name" class="input" type="text"></td>
                        <th><label>名前（名）</label></th>
                        <td><input name="f_name" class="input" type="text"></td>
                        <th><label>削除</label></th>
                        <td>
                            <input name="delete_check" id="delete" type="checkbox"><label for="delete"></label><strong>未</strong>
                            <input name="restoration_check" id="restoration" type="checkbox"><label for="restoration"></label><strong>済</strong>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <th></th>
                        <td></td>
                        <th><label></label></th>
                        <td class="left"><button class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </form> -->
        <div class="search">
            <table class="search__condition1">
                <tbody>
                    <tr>
                        <th><label>ID</label></th>
                        <td><input id="id" class="input" type="text"></td>
                        <th><label>ログインID</label></th>
                        <td><input id="login_id" class="input" type="text"></td>
                        <th><label>ハンドルネーム</label></th>
                        <td><input id="handlename" class="input" type="text"></td>
                    </tr>
                    <tr>
                        <th><label>名前（姓）</label></th>
                        <td><input id="l_name" class="input" type="text"></td>
                        <th><label>名前（名）</label></th>
                        <td><input id="f_name" class="input" type="text"></td>
                        <th><label>削除</label></th>
                        <td>
                            <input id="not_delete" type="checkbox"><label for="not_delete"></label><strong>未</strong>
                            <input id="deleted" type="checkbox"><label for="deleted"></label><strong>済</strong>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <th></th>
                        <td></td>
                        <th><label></label></th>
                        <td class="left"><button id="submit" class="search__btn border_radius--small" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
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
                    <th class="sort">登録日</th>
                    <th>詳細</th>
                    <th class="sort">削除</th>
                    <th class="sort">復元</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $row) {
                ?>
                <tr name="userslist">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['login_id']; ?></td>
                    <td><?php echo $row['handlename']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['inserted_date']; ?></td>
                    <td><a class="black" href="../controller/userdetail_controller.php?friend_id=<?php echo $row['id'] ?>">詳細</a></td>
                    <!-- 下2行はphpのissetで値があれば表示する -->
                    <td><a class="red" href="../controller/userslist_controller.php?id=<?php echo $row['id'] ?>.&judge=delete"><?php if ($row['delete_flag'] == 0) echo "削除"?></a></td>
                    <td><a class="blue" href="../controller/userslist_controller.php?id=<?php echo $row['id'] ?>"><?php if ($row['delete_flag'] == 1) echo "復元"?></a></td>
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