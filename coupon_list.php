<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $sqlCoupons = "SELECT * FROM coupons WHERE disabled = 0";
    $result = $conn->query($sqlCoupons);
    // while($row = $resultCate->fetch_assoc()) {
    //     // $category[$rowCate["id"]]=$rowCate["name"];
    //     echo "id: " . $row["coupons_id"]. " : 序號: " . $row["serial_number"]. ", 使用會員: " . $row["used_member_id"]. ", 使用時間: ".$row["used_time"]."<br>";
    // }
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
        <title>折價券資料一覽 - <?= $websiteTitle ?></title>
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
                            折價券資料一覽
                            <a href="coupon_new.php" class="btn btn-success ml-3">
                                <i class="far fa-plus-square"></i>
                                新增折價券
                            </a>
                        </h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>折價券ID</th>
                                                <th>序號</th>
                                                <th>折扣比率</th>
                                                <th>折扣金額</th>
                                                <th>折扣門檻</th>
                                                <th>剩餘次數</th>
                                                <th>生成時間</th>
                                                <th>使用期限</th>
                                                <th>狀態</th>
                                                <th>刪除</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td><?= $row["coupon_id"]  ?></td>
                                                    <td><?= $row["serial_number"] ?></td>
                                                    <td class="<?= !isset($row["discount_percentage"]) ? 'bg-dark' : '' ?>"><?= $row["discount_percentage"] ?></td>
                                                    <td class="<?= !isset($row["discount_amount"]) ? 'bg-dark' : '' ?>"><?= $row["discount_amount"] ?></td>
                                                    <td><?= $row["discount_threshold"] ?></td>
                                                    <td><?= $row["limit_count"] ?></td>
                                                    <td><?= $row["created_time"] ?></td>
                                                    <td><?= $row["expired_time"] ?></td>
                                                    <td>
                                                        <?php if (date("Y-m-d H:i:s") > $row["expired_time"]): ?>
                                                            <span class="text-danger">已過期</span>
                                                        <?php else: ?>
                                                            <span class="">正常</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <form action="coupon_delete.php" method="post">
                                                            <button class="btn btn-danger text-nowrap">刪除</button>
                                                            <input type="hidden" name="coupon_id" value="<?= $row["coupon_id"] ?>">
                                                        </form>
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
