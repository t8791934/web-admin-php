<?php
    declare(strict_types=1);
    error_reporting(E_ALL);

    require 'includes/authorize.php';
    require 'utils/db_connect_pdo.php';

    $tableName = 'recipes';

    $pk = $_POST['pk'];

    $pkConditions = join(' AND ', array_map(fn ($k ,$v) => "$k = $v", array_keys($pk), $pk));
    $sql = <<<"SQL"
        UPDATE $tableName
        SET disabled = TRUE
        WHERE $pkConditions;
    SQL;
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($fields);
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
                window.location.replace('recipe_list.php');
            });
        </script>
        <!-- script-end -->
    </body>
</html>
