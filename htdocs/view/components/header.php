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
                            <li class="menu-list__item menu-list__btn"><a href="top.php">トップ</a></li>
                            <li class="menu-list__item menu-list__btn"><a href="login.php">ログイン</a></li>
                            <li class="menu-list__item menu-list__btn"><a href="#">ログアウト</a></li>
                            <li class="menu-list__item menu-list__btn"><a href="signup.php">新規登録</a></li>
                            <li class="menu-list__item menu-list__btn"><a href="mypage.php">マイページ</a></li>
                            <li class="menu-list__item menu-list__btn"><a href="categoryList.php"><?php echo "カテゴリ1"; ?></a></li>
                            <li class="menu-list__item menu-list__btn"><a href="#"><?php echo "カテゴリ2"; ?></a></li>
                            <li class="menu-list__item menu-list__btn"><a href="#"><?php echo "カテゴリ3"; ?></a></li>
                            <li class="menu-list__item menu-list__btn"><a href="#">ヘルプ</a></li>
                        </ul>
                    </nav>
                </div>
                <a href="top.php" class="top-title"><h1>研修掲示板</h1></a>
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
                    <li class="top-list__item top-list__item--signup "><a href="signup.php"><p><i class="fa-solid fa-user-plus"></i>新規登録</p></a></li>
                    <li class="top-list__item top-list__item--login"><a href="login.php"><p><i class="fa-solid fa-arrow-right-to-bracket faa-bounce animated-hover"></i>ログイン</p></a></li>
                    <li class="top-list__item top-list__item--logout"><a href=""><p><i class="fa-solid fa-arrow-right-from-bracket faa-bounce animated-hover"></i>ログアウト</p></a></li>
                    <li class="top-list__item top-list__item--help"><a href=""><p><i class="fa-solid fa-circle-question faa-bounce animated-hover"></i>ヘルプ</p></a></li>
                </ul>
            </div>
        </header>