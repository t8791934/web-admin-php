<?php
   require 'includes/authorize.php';
   require "utils/db_connect_mysqli.php";

    $member_id = $_GET["member_id"];

    $sql = "SELECT * FROM members WHERE member_id = $member_id";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>編輯會員資料 - <?= $websiteTitle ?></title></title>
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
                    <div class="container mt-5">
                        <?php if($result->num_rows > 0): ?>
                            <?php $row = $result->fetch_assoc(); ?>
                            <form action="member_update.php" method="post" enctype="multipart/form-data">
                                <h1 class="mb-4">編輯會員資料</h1>
                                <img class="mb-3" style="width:200px; height:200px;" src="<?=$row["avatar_image_src"]?>" alt="">

                                <div class="my-3">
                                    <label>會員圖片: </label><br>
                                    <input type="file" class="form-control" value="" name="avatar_image_file">
                                </div>
                                <div class="my-3">
                                    <label>會員ID: </label>
                                    <input type="text" class="form-control" value="<?=$row["member_id"]?>" name="member_id" readonly>
                                </div>
                                <div class="my-3">
                                    <label>帳號: </label>
                                    <input type="text" class="form-control" value="<?=$row["username"]?>" name="username" readonly>
                                </div>
                                <div class="my-3">
                                    <label>密碼: </label>
                                    <input type="text" class="form-control" value="<?=$row["password"]?>" name="password">
                                </div>
                                <div class="my-3">
                                    <label>會員名稱: </label>
                                    <input type="name" class="form-control" value="<?=$row["name"]?>" name="name">
                                </div>
                                <div class="my-3">
                                    <label>性別: </label>
                                    <input type="text" class="form-control" value="<?=$row["gender"]?>" name="gender">
                                </div>
                                <div class="my-3">
                                    <label>出生日期: </label>
                                    <input type="date" class="form-control" value="<?=$row["birth_date"]?>" name="birth_date">
                                </div>
                                <div class="my-3">
                                    <label>地址: </label>
                                    <input type="text" class="form-control" value="<?=$row["address"]?>" name="address">
                                </div>
                                <div class="my-3">
                                    <label>電話號碼: </label>
                                    <input type="tel" class="form-control" value="<?=$row["phone_number"]?>" name="phone_number">
                                </div>
                                <div class="my-3">
                                    <label>電子信箱: </label>
                                    <input type="email" class="form-control" value="<?=$row["email"]?>" name="email">
                                </div>
                                <div class="my-3">
                                    <label>建立時間: </label>
                                    <input type="text" class="form-control" value="<?= $row["created_time"] ?>" name="created_time" readonly>
                                </div>
                                <div class="my-3">
                                    <label>修改時間: </label>
                                    <input type="text" class="form-control" value="<?= $row["modified_time"] ?>" name="modified_time" readonly>
                                </div>

                                <div class="py-3">
                                    <button class="btn btn-danger" type="button" onclick="document.getElementById('del_member').submit();">刪除此筆資料</button>
                                    <input type="hidden" name="member_id" value="<?=$row["member_id"]?>">
                                    <button type="submit" class="btn btn-primary text-white float-right">確認修改</button>
                                    <a class="btn btn-secondary text-white float-right mr-2" href="member_list.php">回上一頁</a>
                                </div>
                            </form>
                            <form id="del_member" action="member_delete.php" method="post">
                                <input type="hidden" name="member_id" value="<?= $row["member_id"] ?>">
                            </form>
                        <?php else: ?>
                            沒有這筆資料
                        <?php endif; ?>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
