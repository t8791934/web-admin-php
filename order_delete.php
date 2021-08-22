<?php
    require 'includes/authorize.php';
    require_once "utils/db_connect_mysqli.php";

    $id = $_GET["id"];

    $ordersql = "SELECT * FROM orders";
    $orders = $conn->query($ordersql);

    while($row = $orders->fetch_assoc()) {
        $id = $row["id"];
    };

    $deletesql = "UPDATE orders SET disabled = 1 WHERE id = $id";
    $deleteorder = $conn->query($deletesql);

    if ($conn->query($deletesql) === TRUE) {
        // echo "刪除成功";
        header("location:order_list.php");
    } else {
        echo "更新資料錯誤: " . $conn->error;
    }
?>
