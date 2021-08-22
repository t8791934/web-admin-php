<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $member_id = $_POST["member_id"];

    $sql = "UPDATE members SET disabled = TRUE WHERE member_id = $member_id";

    if($conn->query($sql) === TRUE) {
        // echo "刪除成功";
    } else {
        echo "刪除資料錯誤: " . $conn->error;
        exit;
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
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: '刪除成功！',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(function () {
                            window.location.replace('member_list.php');
                        });
                    </script>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
