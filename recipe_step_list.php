<?php
    declare(strict_types=1);
    error_reporting(E_ALL);

    require 'includes/authorize.php';
    require 'utils/db_connect_pdo.php';
    require 'utils/helpers.php';

    $mainTableName = 'recipes';
    $subTableName = 'recipe_steps';

    $pk = $_GET['pk'];

    // get the rows
    $pkConditions = join(' AND ', array_map(fn ($k ,$v) => "$k = $v", array_keys($pk), $pk));
    $stmt = $dbConn->prepare(<<<"SQL"
        SELECT * FROM $subTableName
        WHERE $pkConditions
    SQL);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    array_push($rows, [
      'description' => '',
    ]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <style>
        </style>
        <!-- head-end -->
        <title>編輯食譜步驟 - <?= $websiteTitle ?></title>
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
                      <h1 class="my-4">編輯食譜步驟</h1>
                      <form action="recipe_step_edit.php" method="post">
                        <div>
                          <?php foreach ($rows as $row): ?>
                            <div class="row">
                              <div class="col-auto d-flex align-items-center">
                                <button
                                  type="button" class="btn btn-success btn-sm text-nowrap mx-1" onclick="addItem(this);"
                                  style="position: relative; top: 25px"
                                >
                                  <i class="fas fa-plus"></i>
                                </button>
                              </div>
                              <div class="col">
                                <input type="text" class="form-control my-2 " name="steps[]" value="<?= $row['description'] ?>">
                              </div>
                              <div class="col-auto d-flex align-items-center">
                                <button type="button" class="btn btn-danger text-nowrap mx-1" onclick="deleteItem(this);">
                                  <i class="fas fa-trash-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary text-nowrap mx-1" onclick="moveUpItem(this);">
                                  <i class="fas fa-arrow-up"></i>
                                </button>
                                <button type="button" class="btn btn-primary text-nowrap mx-1" onclick="moveDownItem(this);">
                                  <i class="fas fa-arrow-down"></i>
                                </button>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <div class="d-flex justify-content-between py-5">
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
        <script>
            function addItem(self) {
                let e = self.parentNode.parentNode;
                let ee = document.createElement('div');
                ee.classList.add('row');
                ee.innerHTML = `
                    <div class="col-auto d-flex align-items-center">
                    <button
                        type="button" class="btn btn-success btn-sm text-nowrap mx-1" onclick="addItem(this);"
                        style="position: relative; top: 25px"
                    >
                        <i class="fas fa-plus"></i>
                    </button>
                    </div>
                    <div class="col">
                    <input type="text" class="form-control my-2 " name="steps[]" value="">
                    </div>
                    <div class="col-auto d-flex align-items-center">
                    <button type="button" class="btn btn-danger text-nowrap mx-1" onclick="deleteItem(this);">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary text-nowrap mx-1" onclick="moveUpItem(this);">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <button type="button" class="btn btn-primary text-nowrap mx-1" onclick="moveDownItem(this);">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                    </div>
                `;
                e.insertAdjacentElement('afterend', ee);
            }
            function deleteItem(self) {
                let e = self.parentNode.parentNode;
                if (e.parentNode.childElementCount > 1)
                    e.remove();
                event.preventDefault();
            }
            function moveUpItem(self) {
                let e = self.parentNode.parentNode;
                e.previousElementSibling.insertAdjacentElement('beforebegin', e);
            }
            function moveDownItem(self) {
                let e = self.parentNode.parentNode;
                e.nextElementSibling.insertAdjacentElement('afterend', e);
            }
        </script>
        <!-- script-end -->
    </body>
</html>
