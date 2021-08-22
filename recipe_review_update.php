<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $review_id = $_POST["review_id"];
    $content = $_POST["content"];
    $rating = $_POST["rating"];

    $sql = "UPDATE recipe_reviews SET
        content = '$content', rating = '$rating'
    WHERE review_id = $review_id";

    if ($conn->query($sql) === TRUE) {
        echo "更新成功";
        // header("location: recipe_review_list.php?review_id=".$review_id);
    } else {
        echo "更新資料錯誤: " . $conn->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>修改中... - <?= $websiteTitle ?></title>
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
                title: '修改成功！',
                showConfirmButton: false,
                timer: 1000,
            }).then(function () {
                window.location.replace(document.referrer);
            });
        </script>
        <!-- script-end -->
    </body>
</html>
