<?php
    declare(strict_types=1);
    error_reporting(E_ALL);

    require 'includes/authorize.php';
    require 'utils/db_connect_pdo.php';
    require 'utils/helpers.php';

    $tableName = 'recipes';
    $formTarget = 'recipe_view.php';

    $stmt = $dbConn->prepare(<<<"SQL"
        SHOW TABLE STATUS WHERE Name = '$tableName';
    SQL);
    $stmt->execute();
    $tableComment = $stmt->fetch(PDO::FETCH_ASSOC)['Comment'];

    $stmt = $dbConn->prepare(<<<"SQL"
        SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'
    SQL);
    $stmt->execute();
    $pkNames = array_map(
        fn ($e) => $e['Column_name'],
        $stmt->fetchAll(PDO::FETCH_ASSOC),
    );

    $stmt = $dbConn->prepare(<<<"SQL"
        SHOW FULL COLUMNS FROM $tableName;
    SQL);
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $dbConn->prepare(<<<"SQL"
        SELECT * FROM $tableName
        WHERE disabled != TRUE;
    SQL);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <title><?= $tableComment ?>一覽 - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4"><?= $tableComment ?>一覽</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap"><i class="far fa-eye"></i></th>
                                                <?php foreach ($columns as $column): ?>
                                                    <?php if ($column['Field'] === 'disabled') continue; ?>
                                                    <th class="text-nowrap">
                                                        <?= $column['Comment'] ?><br>
                                                        <!-- <small><?= $column['Field'] ?>: <?= strtoupper($column['Type']) ?></small> -->
                                                    </th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rows as $row): ?>
                                                <tr>
                                                    <td style="width: 20px;">
                                                        <form action="<?= $formTarget ?>" method="get">
                                                            <?php foreach ($pkNames as $pkName): ?>
                                                                <input type="hidden" name="pk[<?= $pkName ?>]" value="<?= $row[$pkName] ?>">
                                                            <?php endforeach; ?>
                                                            <button
                                                                type="submit"
                                                                class="btn btn-outline-primary btn-sm text-nowrap"
                                                                role="button"
                                                            >
                                                                <i class="far fa-eye"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <?php foreach ($columns as $column): ?>
                                                        <?php if ($column['Field'] === 'disabled') continue; ?>
                                                        <?php $cell = nullableEscape($row[$column['Field']]) ?>
                                                        <td class="text-truncate" style="max-width: 240px;">
                                                            <?php if ($cell !== null): ?>
                                                                <?php if ($column['Type'] === 'tinyint(1)'): ?>
                                                                    <b><?= $cell ? '是' : '否' ?></b>
                                                                <?php elseif (endsWith($column['Field'], 'image_src')): ?>
                                                                    <img src="<?= $cell ?>" height="50" width="50" loading="lazy">
                                                                <?php elseif (endsWith($column['Field'], 'src')): ?>
                                                                    <a href="<?= $cell ?>" target="_blank">LINK</a>
                                                                <?php else: ?>
                                                                    <?= $cell ?>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="text-muted font-italic">(無資料)</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
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
