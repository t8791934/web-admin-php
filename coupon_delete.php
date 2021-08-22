<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $coupon_id=$_POST["coupon_id"];

    $sql = "UPDATE coupons SET `disabled` = 1 WHERE `coupon_id` = '$coupon_id'";
    if ($conn->query($sql) === TRUE) {
        // echo "刪除成功";
        // header("location: coupon_list.php");
    } else {
        echo "刪除資料錯誤: " . $conn->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>刪除中... - <?= $websiteTitle ?></title>
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
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
        <!-- script-start -->
        <script>
            Swal.fire({
                icon: 'warning',
                title: '刪除成功！',
                showConfirmButton: false,
                timer: 1000,
            }).then(function () {
                window.location.replace('coupon_list.php');
            });
        </script>
        <!-- script-end -->
    </body>
</html>
