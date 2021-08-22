<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $sqlCoupons = "SELECT * FROM coupons WHERE disabled = 0";
    $result = $conn->query($sqlCoupons);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script type="text/javascript" src="dist/js/propeller.min.js"></script>
        <script type="text/javascript" language="javascript" src="datetimepicker/js/moment-with-locales.js"></script>
        <script type="text/javascript" language="javascript" src="datetimepicker/js/bootstrap-datetimepicker.js"></script>

        <!-- head-end -->
        <title>新增折價券 - <?= $websiteTitle ?></title>
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
                        <form action="./coupon_insert.php" method="post">
                            <h1 class="mt-4 mb-4" >新增折價券</h1>
                            <div class="form-group">
                                <label >折扣種類</label>
                                <select class="form-control" id="mySelect" name="discount_type" required>
                                    <option value="" selected>請選擇折扣種類</option>
                                    <option value="percentage">折扣比率</option>
                                    <option value="amount">折扣金額</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>折扣比率</label>
                                <select class="form-control" name="discount_percentage" id="percentage" disabled required>
                                    <option value="" selected>請選擇折扣比率</option>
                                    <option value="0.9">9折</option>
                                    <option value="0.85">85折</option>
                                    <option value="0.5">5折</option>
                                    <option value="0.1">1折</option>
                                    <option value="0">全額折抵</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>折扣金額</label>
                                <input
                                    class="form-control" type="number" name="discount_amount" id="amount"
                                    placeholder="請輸入折扣金額"
                                    disabled required
                                >
                            </div>
                            <div class="form-group">
                                <label>折扣門檻</label>
                                <input class="form-control" type="number" name="discount_threshold" value="0" required>
                            </div>
                            <div class="form-group">
                                <label>剩餘次數</label>
                                <input class="form-control" type="number" name="limit_count" value="5">
                            </div>
                            <div class="form-group">
                                <label>張數</label>
                                <input class="form-control" type="number" name="count" value="1">
                            </div>
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label>使用期限</label>
                                <div class="input-group">
                                    <input class="form-control" type="date" name="date" required />
                                    <input class="form-control" type="time" name="time" value="23:59" required />
                                </div>
                            </div>
                            <div class="button py-3 ball text-right">
                                <a href="coupon_list.php" class="btn btn-secondary mr-2">回上一頁</a>
                                <button type="submit" class="btn btn-primary" id="add">
                                    <!-- <i class="fas fa-clipboard-check"></i> -->
                                    確定送出
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
        <script>
            document.getElementById('mySelect')
                .addEventListener('change', function () {
                    let typeVal = this.value;
                    // console.log(typeVal);

                    if (typeVal==="percentage") {
                        $('#amount').attr('disabled','disabled');
                        $('#percentage').removeAttr('disabled');
                    } else if (typeVal === "amount") {
                        $('#percentage').attr('disabled','disabled');
                        $('#amount').removeAttr('disabled');
                    } else {
                        $('#percentage').attr('disabled','disabled');
                        $('#amount').attr('disabled','disabled');
                    }
                });
        </script>
    </body>
</html>
