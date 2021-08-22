<?php
    require 'includes/authorize.php';
    require_once "utils/db_connect_mysqli.php";

    $status = $_POST["status"];

    $ordersql = "SELECT * FROM orders";
    $orders = $conn->query($ordersql);

    while($row=$orders->fetch_assoc()) {
        $id=$row["id"];
    };

    $updatesql = "UPDATE orders SET order_status = $status WHERE id = $id";
    $updateorder = $conn->query($updatesql);

    if($conn->query($updatesql) === TRUE){
        // echo "更新成功";
        header("location:order_list.php");
    } else {
        echo "更新資料錯誤: " . $conn->error;
    }
?>
