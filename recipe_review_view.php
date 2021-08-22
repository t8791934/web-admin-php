<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $review_id = $_GET["review_id"];

    $sql = "SELECT * FROM recipe_reviews WHERE review_id = $review_id";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>編輯食譜評論資料 - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4">
                            編輯食譜評論資料
                        </h1>
                        <?php if($result->num_rows > 0): ?>
                            <?php $row = $result->fetch_assoc(); ?>

                            <form action="recipe_review_update.php" method="post">
                                <input type="hidden" name="review_id" value="<?= $row["review_id"] ?>">

                                <div class="my-3">
                                    <label>留言ID</label>
                                    <input type="text" class="form-control" name="review_id" value="<?= $row["review_id"] ?>" disabled>
                                </div>
                                <div class="my-3">
                                    <label>會員ID</label>
                                    <input type="text" class="form-control" name="member_id" value="<?= $row["member_id"] ?>" readonly>
                                </div>
                                <div class="my-3">
                                    <label>評論內容</label>
                                    <textarea class="form-control" rows="3" name="content"><?= $row["content"] ?></textarea>
                                </div>
                                <div class="my-3">
                                    <label>評分</label>
                                    <input type="number" class="form-control" name="rating" value="<?= $row["rating"] ?>" required>
                                </div>
                                <div class="my-3">
                                    <label>建立時間</label>
                                    <input type="text" class="form-control"  name="created_time" value="<?= $row["created_time"] ?>" disabled>
                                </div>
                                <div class="my-3">
                                    <label>修改時間</label>
                                    <input type="text" class="form-control"  name="modified_time" value="<?= $row["modified_time"] ?>" disabled>
                                </div>
                                <div class="py-3">
                                    <button type="button" class="btn btn-danger"  onclick="confirmDeletion();">刪除此筆資料</button>
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary text-white mr-2">確定修改</button>
                                        <a href="recipe_review_list.php" class="btn btn-secondary text-white">回上一頁</a>
                                    </div>
                                </div>
                            </form>
                            <form action="recipe_review_delete.php" method="post" id="review_id">
                                <input type="hidden" name="review_id" value="<?= $row["review_id"] ?>">
                            </form>
                        <?php else: ?>
                            沒有這一筆資料
                        <?php endif; ?>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
        <!-- script-start -->
        <script>
            function confirmDeletion() {
                Swal.fire({
                    title: '你確定要刪除此資料嗎?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '確認刪除',
                    cancelButtonText: '取消動作',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("review_id").submit();
                    }
                });
            }
        </script>
        <!-- script-end -->
    </body>
</html>
