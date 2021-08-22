<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $sql = "SELECT * FROM recipe_reviews ORDER BY review_id DESC";
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
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>食譜評論資料一覽 - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4">食譜評論資料一覽
                            <a href="recipe_review_new.php" class="btn btn-success ml-3">
                                <i class="far fa-plus-square"></i>
                                新增評論
                            </a>
                        </h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if ($result->num_rows > 0): ?>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th><i class="far fa-eye"></i></th>
                                                    <th>留言ID</th>
                                                    <th>會員ID</th>
                                                    <th>評論內容</th>
                                                    <th>建立時間</th>
                                                    <th>修改時間</th>
                                                    <th>評分</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = $result->fetch_assoc()): ?>
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="recipe_review_view.php?review_id=<?= $row["review_id"] ?>"
                                                                class="btn btn-outline-primary btn-sm text-nowrap"
                                                            >
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td><?= $row["review_id"] ?></td>
                                                        <td><?= $row["member_id"] ?></td>
                                                        <td><?= $row["content"] ?></td>
                                                        <td><?= $row["created_time"] ?></td>
                                                        <td><?= $row["modified_time"] ?></td>
                                                        <td><?= $row["rating"] ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        目前沒有資料
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
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
