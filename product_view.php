<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $id=$_GET["id"];

    $sql="SELECT * FROM `products` WHERE `product_id` = $id";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>編輯商品資料 - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4">編輯商品資料</h1>
                        <?php if($result->num_rows>0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <form action="product_update.php" method="post">
                                    <input type="hidden" name="product_id" value="<?=$row["product_id"]?>">

                                    <div class="form-group">
                                        <label>名稱</label>
                                        <input type="text" name="name" class="form-control" value="<?=$row["name"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>類別</label>
                                        <input type="text" name="type_id" class="form-control"  value="<?=$row["type_id"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>產地</label>
                                        <input type="text" name="origin" class="form-control" value="<?=$row["origin"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>規格</label>
                                        <input type="text" name="specification"class="form-control"  value="<?=$row["specification"]?>">
                                    </div>
                                    <div class="form-group">
                                        <label>價錢</label>
                                        <input type="text" name="price" class="form-control" value="<?=$row["price"]?>">
                                    </div>

                                    <div class="py-3">
                                        <button
                                            type="button" class="btn btn-danger"
                                            data-toggle="modal" onclick="deleteRecord();"
                                        >
                                            <!-- <i class="fas fa-trash-alt"></i> -->
                                            刪除此筆資料
                                        </button>
                                        <input type="button" class="btn btn-secondary ml-2 float-right" onclick="history.back()" value="回上一頁">
                                        <button class="btn btn-primary float-right " type="submit">確認修改</button>
                                    </div>
                                </form>
                                <form action="product_delete.php" method="post" id="form_delete">
                                    <input type="hidden" name="product_id" value="<?=$row["product_id"]?>">
                                </form>
                            <?php endwhile; ?>
                        <?php else: ?>
                            沒有資料
                        <?php endif; ?>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
        <!-- script-start -->
        <script>
            function deleteRecord() {
                Swal.fire({
                    title: '確定要刪除此筆資料？',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '確認刪除',
                    cancelButtonText: '取消動作',
                    timer: 5000,
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
