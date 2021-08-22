<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";
    require "utils/helpers.php";

    if(!isset($_POST["discount_type"])){
        exit;
    }

    $discount_type = $_POST["discount_type"];
    $discount_percentage = $_POST["discount_percentage"] ?? 'NULL';
    $discount_amount = $_POST["discount_amount"] ?? 'NULL';
    $discount_threshold = $_POST["discount_threshold"];
    $limit_count = $_POST["limit_count"];
    $count = $_POST["count"];
    $expired_time = $_POST["date"].' '.$_POST["time"];

    // date("Y-m-d H:i:s")
    // TODO: 可選擇有效期限
    // $now = date("Y-m-d");
    // $new_time =(strtotime($date)-strtotime($now))/ (60*60*24);
    // $expired_time= date("Y-m-d", (strtotime("+ $new_time"))) ;
    // echo $expired_time;

    for ($i = 1; $i <= $count; $i++) {
        $serial_number = getRandomString(10);

        $sql = "INSERT INTO coupons (
            serial_number, discount_threshold, discount_percentage, discount_amount, limit_count, expired_time
        ) VALUES (
            '$serial_number', $discount_threshold, $discount_percentage, $discount_amount, $limit_count, '$expired_time'
        )";

        if ($conn->query($sql)) {
            $last_id=$conn->insert_id;
            // echo "資料建立成功, 這筆資料的代號是 $last_id <br>" ;
        } else {
            die("Error: ".$sql."<br>".$conn->error);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>建立中... - <?= $websiteTitle ?></title>
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
                icon: 'success',
                title: '你的折價券已成功製造!',
                showConfirmButton: false,
                // position: 'center-center',
                // imageUrl: 'https://sweetalert2.github.io/images/nyan-cat.gif',
                // imageWidth: 200,
                // imageHeight: 200,
                timer: 1000,
            }).then(function () {
                window.location.replace('coupon_list.php');
            });
        </script>
        <!-- script-end -->
    </body>
</html>
