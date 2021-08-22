<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $sql = "SELECT products.*, product_types.name AS product_type_name
        FROM products LEFT JOIN product_types USING (type_id)
        WHERE `disabled` = 0
    ";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js" defer></script>
        <!-- head-end -->
        <title>商品資料一覽 - <?= $websiteTitle ?></title>
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
                    <div class="container-fluid">
                        <h1 class="my-4">
                            商品資料一覽
                            <a href="product_new.php" class="btn btn-success ml-3">
                                <i class="far fa-plus-square"></i>
                                新增商品
                            </a>
                        </h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px;"><i class="far fa-eye"></i></th>
                                                <th>序號</th>
                                                <th>商品名稱</th>
                                                <th>類別</th>
                                                <th>產地</th>
                                                <th>規格</th>
                                                <th>價格</th>
                                                <th>圖片</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td>
                                                        <a href="product_view.php?id=<?=$row["product_id"]?>" class="btn btn-outline-primary btn-sm">
                                                            <i class="far fa-eye"></i></th>
                                                        </a>
                                                    </td>
                                                    <td><?= $row["product_id"] ?></td>
                                                    <td><?= $row["name"] ?></td>
                                                    <td><?= $row["product_type_name"] ?></td>
                                                    <td><?= $row["origin"] ?></td>
                                                    <td><?= $row["specification"] ?></td>
                                                    <td>$<?=$row["price"]?></td>
                                                    <td>
                                                        <img class="cover-fit" name="file" src="<?=$row["image_src"]?>" alt="" height="50" width="50">
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
