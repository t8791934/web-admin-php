<?php
    require 'includes/authorize.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->

        <!-- head-end -->
        <title>新增食譜評論資料 - <?= $websiteTitle ?></title>
    </head>
    <body class="sb-nav-fixed">
        <?php require 'includes/topnav.php'; ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <?php require 'includes/sidenav.php'; ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <!-- content-start -->
                    <div class="container">
                        <h1 class="my-4">新增食譜評論資料</h1>
                        <form class="form" action="recipe_review_insert.php" method="post">
                            <table class="table table-bordered">
                                <div class="form-group">
                                    <label>會員ID</label>
                                    <input type="text" class="form-control" name="member_id" required>
                                </div>
                                <div class="form-group">
                                    <label>評論內容</label>
                                    <textarea class="form-control" rows="3" name="content"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>分數</label>
                                    <input type="number" class="form-control" name="rating" required>
                                </div>
                                <div class="float-right py-3">
                                    <a href="recipe_review_list.php" class="btn btn-secondary mr-2">回上一頁</a>
                                    <button class="btn btn-primary" type="submit">確定送出</button>
                                </div>
                            </table>
                        </form>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
