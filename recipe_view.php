<?php
    declare(strict_types=1);
    error_reporting(E_ALL);

    require 'includes/authorize.php';
    require 'utils/db_connect_pdo.php';
    require 'utils/helpers.php';

    $tableName = 'recipes';
    $updateAction = 'recipe_update.php';
    $deleteAction = 'recipe_delete.php';
    $backPage = 'recipe_list.php';

    $pk = $_GET['pk'];

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

    // get the row
    $pkConditions = join(' AND ', array_map(fn ($k ,$v) => "$k = $v", array_keys($pk), $pk));
    $stmt = $dbConn->prepare(<<<"SQL"
        SELECT * FROM $tableName
        WHERE $pkConditions
    SQL);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>編輯<?= $tableComment ?> - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4">編輯<?= $tableComment ?></h1>
                        <form action="<?= $updateAction ?>" method="post" id="form_edit">
                            <?php foreach ($pk as $k => $v): ?>
                                <input type="hidden" name="pk[<?= $k ?>]" value="<?= $v ?>">
                            <?php endforeach; ?>

                            <?php foreach ($columns as $column): ?>
                                <?php if ($column['Field'] === 'disabled') continue; ?>

                                <?php $cell = nullableEscape($row[$column['Field']]) ?>
                                <div class="mb-3">
                                    <label class="form-label"><?= $column['Comment'] ?></label>
                                    <?php if (false
                                        || isset($pk[$column['Field']])
                                        || $column['Field'] === 'created_time'
                                        || $column['Field'] === 'modified_time'
                                    ): ?>
                                        <input type="text" class="form-control" value="<?= $cell ?>" disabled>
                                    <?php elseif ($column['Type'] === 'tinyint(1)'): ?>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="fields[<?= $column['Field'] ?>]"
                                                    value="1" <?= $cell ? 'checked' : '' ?>
                                                >
                                                <label class="form-check-label">是</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    type="radio"
                                                    class="form-check-input"
                                                    name="fields[<?= $column['Field'] ?>]"
                                                    value="0" <?= !$cell ? 'checked' : '' ?>
                                                >
                                                <label class="form-check-label">否</label>
                                            </div>
                                        </div>
                                    <?php elseif (endsWith($column['Field'], '_time')): ?>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            name="fields[<?= $column['Field'] ?>]"
                                            value="<?= $cell ?>"
                                            placeholder="(無資料)"
                                        >
                                    <?php else: ?>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="fields[<?= $column['Field'] ?>]"
                                            value="<?= $cell ?>"
                                            placeholder="(無資料)"
                                        >
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </form>
                        <form action="<?= $deleteAction ?>" method="post" id="form_delete">
                            <?php foreach ($pk as $k => $v): ?>
                                <input type="hidden" name="pk[<?= $k ?>]" value="<?= $v ?>">
                            <?php endforeach; ?>
                        </form>
                        <div class="d-flex justify-content-between py-3">
                            <button class="btn btn-danger" role="button" onclick="deleteRecord();">
                                刪除此筆資料
                            </button>
                            <div>
                                <a class="btn btn-secondary mr-2" role="button" href="<?= $backPage ?>">
                                    回上一頁
                                </a>
                                <button type="submit" class="btn btn-primary" role="button" onclick="editRecord();">
                                    確認修改
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
        <!-- script-start -->
        <script>
            function editRecord() {
                document.getElementById('form_edit').submit();
            }
            function deleteRecord() {
                Swal.fire({
                    title: '確定要刪除此筆資料？',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '確認刪除',
                    cancelButtonText: '取消動作',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form_delete').submit();
                    }
                });
            }
        </script>
        <!-- script-end -->
    </body>
</html>
