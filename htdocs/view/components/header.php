<!DOCTYPE html>
<html>
    <head>
        <title><?=$title?></title>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="scss/base.css"> -->
        <link rel="stylesheet" href="scss/headerfootermenu.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css">
        <link rel="stylesheet" href="<?=$url?>">
        <link rel="icon" type="image/x-icon" href="image/favicon.ico">
    </head>
    <?php
    session_start();
    if (!isset($_SESSION['category'])) {
        header("Location: ../../controller/header_controller.php");
        exit;
    }
    else {
        $category = $_SESSION['category'];
    }
    ?>
    <body>
        <header>
            <div class="top-head">
                <div class="humberger-menu">
                    <input type="checkbox" id="menu-btn-check">
                    <label for="menu-btn-check" class="menu-btn"><span class="menu-btn__span"></span></label>
                    <label for="menu-btn-check" class="menu-filter"></label>
                    <nav class="menu-list">
                        <div class="menu-list__top"></div>
                        <ul class="menu-list__contents font-size--15">
                            <!-- カテゴリはループ表示 -->
                            <!-- ログイン等の表示切替 -->
                            <li class="menu-list__item menu-list__btn"><a href="../controller/index_controller.php">トップ</a></li>
                            <?php
                            if (isset($_SESSION['login'])) {
                                echo '<li class="menu-list__item menu-list__btn"><a href="../controller/logout_controller.php">ログアウト</a></li>';
                                if ($_SESSION['role'] == 1) {
                                    echo '<li class="menu-list__item menu-list__btn"><a href="../controller/adminpage_controller.php">管理者ページ</a></li>';
                                }
                                else {
                                    echo '<li class="menu-list__item menu-list__btn"><a href="../controller/mypage_controller.php">マイページ</a></li>';
                                }
                                echo '<li class="menu-list__item menu-list__btn"><a href="threadCreate.php">スレッド作成</a></li>';
                            }
                            else {
                                echo '<li class="menu-list__item menu-list__btn"><a href="login.php">ログイン</a></li>';
                                echo '<li class="menu-list__item menu-list__btn"><a href="signup.php">新規登録</a></li>';
                            }

                            foreach ($category as $row) {
                            ?>
                            <li class="menu-list__item menu-list__btn"><a href="../../controller/index_controller.php?category=<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="menu-list__item menu-list__btn"><a href="#">ヘルプ</a></li>
                        </ul>
                    </nav>
                </div>
                <a href="../controller/index_controller.php" class="top-title"><h1>研修掲示板</h1></a>
                <div class="top-right"></div>
            </div>
            <div class="top-foot">
                <ul class="top-list font-size--15">
                    <!-- ログイン等の表示切替 -->
                    <li class="top-list__item"></li>
                    <li class="top-list__item"></li>
                    <li class="top-list__item"></li>
                    <li class="top-list__item"></li>
                    <li class="top-list__item"></li>
                    <li class="top-list__item"></li>
                    <li class="top-list__item"></li>
                    <?php 
                    if (isset($_SESSION['login'])) {
                        if ($_SESSION['role'] == 1) {
                            echo '<li class="top-list__item top-list__item--adminpage"><a href="../controller/adminpage_controller.php"><p><i class="fa-solid fa-user-gear"></i></p><p>管理者ページ</p></a></li>';
                        }
                        else {
                            echo '<li class="top-list__item top-list__item--mypage"><a href="../controller/mypage_controller.php"><p><i class="fa-solid fa-user"></i></p><p>マイページ</p></a></li>';
                        }
                        echo '<li class="top-list__item top-list__item--threadCreate"><a href="threadCreate.php"><p><i class="fa-solid fa-pen-to-square"></i></p><p>スレッド作成</p></a></li>';
                        echo '<li class="top-list__item top-list__item--logout"><a href="../controller/logout_controller.php"><p><i class="fa-solid fa-arrow-right-from-bracket"></i></p><p>ログアウト</p></a></li>';
                    }
                    else {
                        echo '<li class="top-list__item top-list__item--signup "><a href="signup.php"><p><i class="fa-solid fa-user-plus"></i></p><p>新規登録</p></a></li>';
                        echo '<li class="top-list__item top-list__item--login"><a href="login.php"><p><i class="fa-solid fa-arrow-right-to-bracket"></i></p><p>ログイン</p></a></li>';
                    }
                    ?>
                    <li class="top-list__item top-list__item--help"><a href="#"><p><i class="fa-solid fa-circle-question"></p><p></i>ヘルプ</p></a></li>
                </ul>
            </div>
        </header>