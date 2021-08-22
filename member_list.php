<?php
   require 'includes/authorize.php';
   require "utils/db_connect_mysqli.php";

   $sql= "SELECT * FROM `members` WHERE `disabled` = 0";
   $result = $conn->query($sql);
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
        <title>會員資料一覽 - <?= $websiteTitle ?></title>
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
                        <h1 class="my-4">
                            會員資料一覽
                            <button type="button" class="btn btn-success ml-3" data-toggle="modal" data-target="#exampleModal">
                                <i class="far fa-plus-square"></i>
                                新增會員
                            </button>
                        </h1>

                        <!-- 新增會員 Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form class="form py-3" action="member_insert.php" method="post" enctype="multipart/form-data">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title" id="exampleModalLabel">新增會員</h1>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <label>會員圖片: </label>
                                                <input type="file" class="form-control mb-4" value="" name="avatar_image_file">
                                            </div>
                                            <div class="form-group">
                                                <label for="">帳號: </label>
                                                <input type="account" class="form-control" name="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">密碼: </label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">會員名稱: </label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">性別: </label>
                                                <input type="text" class="form-control" name="gender">
                                            </div>
                                            <div class="form-group">
                                                <label for="">出生日期: </label>
                                                <input type="date" class="form-control" name="birth_date">
                                            </div>
                                            <div class="form-group">
                                                <label for="">地址: </label>
                                                <input type="address" class="form-control" name="address">
                                            </div>
                                            <div class="form-group">
                                                <label for="">電話號碼: </label>
                                                <input type="tel" class="form-control mt-2" name="phone_number">
                                            </div>
                                            <div class="form-group">
                                                <label for="">電子信箱: </label>
                                                <input type="email" class="form-control mt-2" name="email">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">確認送出</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th><i class="far fa-eye"></i></th>
                                                <th>會員ID</th>
                                                <th>帳號</th>
                                                <th>密碼</th>
                                                <th>會員名稱</th>
                                                <th>性別</th>
                                                <th>大頭貼圖片網址</th>
                                                <th>出生日期</th>
                                                <th>地址</th>
                                                <th>電話號碼</th>
                                                <th>電子信箱</th>
                                                <th>建立日期</th>
                                                <th>是否停用</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $result->fetch_assoc()): ?>
                                                <tr>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-sm" href="member_view.php?member_id=<?=$row["member_id"]?>">
                                                            <i class="far fa-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td><?=$row["member_id"]?></td>
                                                    <td><?=$row["username"]?></td>
                                                    <td><?=$row["password"]?></td>
                                                    <td><?=$row["name"]?></td>
                                                    <td><?=$row["gender"]?></td>
                                                    <td><img style="width:50px; height:50px;" src="<?=$row["avatar_image_src"]?>" alt=""></td>
                                                    <td><?=$row["birth_date"]?></td>
                                                    <td><?=$row["address"]?></td>
                                                    <td><?=$row["phone_number"]?></td>
                                                    <td><?=$row["email"]?></td>
                                                    <td><?=$row["created_time"]?></td>
                                                    <td><?=$row["disabled"]?></td>
                                                </tr>
                                            <?php endwhile; ?>
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
    </body>
</html>
