<?php
require "utils/db_connect_mysqli.php";

$id=$_POST["product_id"];

$sql = "UPDATE products SET disabled = 1 WHERE product_id = $id";

if ($conn->query($sql) !== FALSE) {
    // echo "刪除成功";
    header("location: product_list.php");
} else {
    echo "刪除錯誤: " . $conn->error;
}
?>
