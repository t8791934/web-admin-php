<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $member_id = $_POST["member_id"];
    $content = $_POST["content"];
    $rating = $_POST["rating"];

    $sql="INSERT INTO recipe_reviews (
        member_id, content, rating
    ) VALUES (
        '$member_id', '$content', '$rating'
    )";

    if ($conn->query($sql)) {
        $last_id = $conn->insert_id;
        // echo "資料建立成功, 這筆資料的代號是 $last_id";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
                title: '建立成功！',
                showConfirmButton: false,
                timer: 1000,
            }).then(function () {
                window.location.replace('recipe_review_list.php');
            });
        </script>
        <!-- script-end -->
    </body>
</html>
