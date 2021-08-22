<?php
    declare(strict_types=1);
    error_reporting(E_ALL);

    require 'includes/authorize.php';
    require 'utils/db_connect_pdo.php';
    require 'utils/helpers.php';

    $tableName = 'recipes';

    // get table comment
    $stmt = $dbConn->prepare(<<<"SQL"
        SHOW TABLE STATUS WHERE Name = '$tableName';
    SQL);
    $stmt->execute();
    $tableComment = $stmt->fetch(PDO::FETCH_ASSOC)['Comment'];

    // get pkNames
    $stmt = $dbConn->prepare(<<<"SQL"
        SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'
    SQL);
    $stmt->execute();
    $pkNames = array_map(
        fn ($e) => $e['Column_name'],
        $stmt->fetchAll(PDO::FETCH_ASSOC)
    );

    // get columns and comments
    $stmt = $dbConn->prepare(<<<"SQL"
        SHOW FULL COLUMNS FROM $tableName;
    SQL);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <!-- head-end -->
        <title>新增食譜資料 - <?= $websiteTitle ?></title>
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
                    <div class="container">
                        <h1 class="my-4">新增<?= $tableComment ?></h1>
                        <form action="<?= $updateAction ?>" method="post" id="form_edit">
                            <?php foreach ($columns as $column): ?>
                                <?php if (
                                    $column['Field'] === 'disabled'
                                    || in_array($column['Field'], $pkNames)
                                    || $column['Field'] === 'created_time'
                                    || $column['Field'] === 'modified_time'
                                ) continue; ?>

                                <div class="mb-3">
                                    <label class="form-label"><?= $column['Comment'] ?></label>
                                    <?php if ($column['Type'] === 'tinyint(1)'): ?>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="fields[<?= $column['Field'] ?>]"
                                                    value="1"
                                                >
                                                <label class="form-check-label">是</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="fields[<?= $column['Field'] ?>]"
                                                    value="0" checked
                                                >
                                                <label class="form-check-label">否</label>
                                            </div>
                                        </div>
                                    <?php elseif (endsWith($column['Field'], '_time')): ?>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            name="fields[<?= $column['Field'] ?>]"
                                            value=""
                                        >
                                    <?php else: ?>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="fields[<?= $column['Field'] ?>]"
                                            value=""
                                        >
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <div class="d-flex justify-content-between py-3">
                                <div></div>
                                <div>
                                    <a class="btn btn-secondary mr-2" role="button" href="<?= $backPage ?>">
                                        回上一頁
                                    </a>
                                    <button type="submit" class="btn btn-primary" role="button">
                                        確認修改
                                    </button>
                                </div>
                            </div>
                        </form>
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
