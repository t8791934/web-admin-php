<?php
require "utils/db_connect_mysqli.php";

$id=$_POST["product_id"];
$name=$_POST["name"];
$type_id=$_POST["type_id"];
$origin=$_POST["origin"];
$specification=$_POST["specification"];
$price=$_POST["price"];

$sql = "UPDATE products SET
    name = '$name',
    type_id = '$type_id',
    origin = '$origin',
    specification = '$specification',
    price = $price
WHERE product_id = $id";

if ($conn->query($sql) === TRUE) {
    // echo "更新成功";
    header("location: product_list.php");
} else {
    echo "更新資料錯誤: " . $conn->error;
}
?>
