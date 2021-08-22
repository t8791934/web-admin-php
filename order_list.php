<?php
    require 'includes/authorize.php';
    require_once "utils/db_connect_mysqli.php";

    $ordersql = "SELECT * FROM orders WHERE disabled = 0";
    $result = $conn->query($ordersql);

    $orderStatus = "SELECT * FROM order_status";
    $resultStatus = $conn->query($orderStatus);

    while($status = $resultStatus->fetch_assoc()) {
        $checkOrderStatus[$status["status_id"]] = $status["status"];
        // print_r($checkOrderStatus);
    };

    $membersql="SELECT * FROM members ";
    $resultmembers=$conn->query($membersql);

    while($members = $resultmembers->fetch_assoc()){
        $memberName[$members["member_id"]]=$members["username"];
        // print_r($memberName);
    };
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
    <title>訂單資料一覽 - <?= $websiteTitle ?></title>
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
                        訂單資料一覽
                        <a href="demo-product-list.php" class="btn btn-success ml-3" target="_blank">
                            <i class="far fa-plus-square"></i>
                            新增訂單 (前台)
                        </a>
                    </h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px;"><i class="far fa-eye"></i></th>
                                            <th>訂單編號</th>
                                            <th>建立日期</th>
                                            <th>會員帳號</th>
                                            <th>訂單狀態</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row=$result->fetch_assoc()): ?>
                                            <tr>
                                                <td>
                                                    <a href="order_detail.php?id=<?= $row["id"] ?>" class="btn btn-outline-primary btn-sm">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td><?= $row["id"] ?></td>
                                                <td><?= $row["created_time"] ?></td>
                                                <td><?= $memberName[$row["member_id"]] ?></td>
                                                <td><?= $checkOrderStatus[$row["order_status"]] ?></td>
                                                <!-- <td class="text-center">
                                                    <a href="order_detail.php?id=<?= $row["id"] ?>" class="btn btn-info">更新</a>
                                                    <a href="order_delete.php?id=<?= $row["id"] ?>" class="btn btn-info">刪除</a>
                                                </td> -->
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
    <!-- script-start -->
    <!-- script-end -->
</body>

</html>
