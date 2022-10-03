<!-- headのタイトル -->
<?php $title = "研修掲示板ユーザー一覧"; ?>
<!-- cssの適用 -->
<?php $url = "scss/userslist.css"; ?>
<!-- header共通部分 -->
<?php include("header.php"); ?>

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
                <tr>
                    <td><?php echo "1"; ?></td>
                    <td><?php echo "11111111"; ?></td>
                    <td><?php echo "OOOOOOOO"; ?></td>
                    <td><?php echo "関矢"; ?></td>
                    <td><?php echo "創"; ?></td>
                    <td><?php echo "2000/01/01"; ?></td>
                    <td><a class="black" href="#">詳細</a></td>
                    <!-- 下2行はphpのissetで値があれば表示する -->
                    <td><a class="red" href="#"></a></td>
                    <td><a class="blue" href="#">復元</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>YYYYYYYY</td>
                    <td>AAAAAAAA</td>
                    <td>竹政</td>
                    <td>勇輝</td>
                    <td>2000/01/02</td>
                    <td><a class="black" href="#">詳細</a></td>
                    <td><a class="red" href="#">削除</a></td>
                    <td><a class="blue" href="#"></a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ZZZZZZZZ</td>
                    <td>UUUUUUUU</td>
                    <td>大嶋</td>
                    <td>涼巴</td>
                    <td>2000/01/03</td>
                    <td><a class="black"  href="#">詳細</a></td>
                    <td><a class="red" href="#">削除</a></td>
                    <td><a class="blue" href="#"></a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>XXXXXXXX</td>
                    <td>EEEEEEEE</td>
                    <td>新井原</td>
                    <td>玲衣</td>
                    <td>2000/01/04</td>
                    <td><a class="black" href="#">詳細</a></td>
                    <td><a class="red" href="#">削除</a></td>
                    <td><a class="blue" href="#"></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

<!-- jsの適用 -->
<?php $js_url = "js/userslist.js"; ?>
<!-- footer共通部分 -->
<?php include("footer.php"); ?>