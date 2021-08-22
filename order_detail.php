<?php
require 'includes/authorize.php';
require_once "utils/db_connect_mysqli.php";
$id=$_GET["id"];
$ordersql="SELECT * FROM order_detail WHERE order_id=$id";
$detailresult=$conn->query($ordersql);

$productsql="SELECT * FROM products";
$productresult = $conn->query($productsql);
while($products = $productresult->fetch_assoc()) {
   $productName[$products["product_id"]]=$products["name"];
  //  print_r($productName);
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'includes/head.php'; ?>
    <!-- head-start -->
    <!-- head-end -->
    <title>頁面標題 - <?= $websiteTitle ?></title>
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
                    <h1 class="mt-4">訂單細節</h1>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">產品名稱</th>
                                <th scope="col">產品圖片</th>
                                <th scope="col">數量</th>
                                <th scope="col">小計</th>


                            </tr>
                        </thead>

                        <?php
                        $total=0;
                        while($row=$detailresult->fetch_assoc()){
                         $pic= $row["product_id"];
                         $sub=  $row["sub_total"];
                          $total+=$sub;

                        ?>
                        <tbody>
                            <tr>
                                <td><?=$productName[$pic]?></td>
                                <td>
                                    <img src="http://picsum.photos/100/100?random=<?=$pic?>" alt="">
                                </td>
                                <td><?=$row["product_amount"]?></td>
                                <td><?=$sub?></td>

                            </tr>
                        </tbody>
                        <?php };?>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"> 總額: $<?=$total?></td>

                            </tr>
                        </tfoot>
                    </table>

                    <form method="post" action="order_update.php">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">訂單狀態</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status">
                                <option value="1">新訂單</option>
                                <option value="2">處理中</option>
                                <option value="3">未付款</option>
                                <option value="4">已付款</option>
                                <option value="5">未出貨</option>
                                <option value="6">已出貨</option>
                                <option value="7">訂單完成</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between py-3">
                            <a href="order_delete.php?id=<?=$id?>" class=" btn btn-danger" role="button">
                                刪除此筆資料
                            </a>
                            <div>
                                <a class="btn btn-secondary mr-2" role="button" href="order_list.php">
                                    回上一頁
                                </a>
                                <input type="submit" class="btn btn-info" value="確認修改" role="button">

                                </input>
                            </div>
                        </div>
                </div>


                <!-- <input class=" btn btn-info" type="submit" value="確認修改" id="update">
                                <a href="order_delete.php?id=<?=$id?>" class="btn btn-info">刪除</a> -->
                </form>







                <!-- content-end -->
            </main>
            <?php require 'includes/footer.php'; ?>
        </div>
    </div>
    <!-- script-start -->
    <!-- script-end -->
</body>

</html>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="js/scripts.js"></script>

</body>

</html>
