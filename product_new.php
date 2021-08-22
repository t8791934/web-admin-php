<?php
    require 'includes/authorize.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <!-- head-end -->
        <title>新增商品資料 - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4">新增商品資料</h1>
                        <form class="" action="product_insert.php" method="post" enctype="multipart/form-data">
                            <table class="table table-border">
                            <div class="form-group">
                                <label>名稱</label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label>類別</label>
                                <input type="text" class="form-control" name="type_id" value="" required>
                            </div>
                            <div class="form-group">
                                <label>產地</label>
                                <input type="text" class="form-control" name="origin" value="">
                            </div>
                            <div class="form-group">
                                <label>規格</label>
                                <input type="text" class="form-control" name="specification" value="">
                            </div>
                            <div class="form-group">
                                <label>價錢</label>
                                <input type="number" class="form-control" name="price" value="" required>
                            </div>
                            <div class="form-group">
                                <label>圖片</label>
                                <input type="file" class="form-control" name="image_src" value="">
                            </div>
                            <div class="text-right py-3">
                                <input type="button" class="btn btn-secondary mr-2" onclick="history.back()" value="回上一頁">
                                <button class="btn btn-primary" type="submit">確認送出</button>
                            </div>
                            </table>
                        </form>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
        <!-- script-start -->
        <!-- script-end -->
    </body>
</html>
