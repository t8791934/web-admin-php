<?php
    require "utils/db_connect_mysqli.php";

    $name=$_POST["name"];
    $type_id=$_POST["type_id"];
    $origin=$_POST["origin"];
    $specification=$_POST["specification"];
    $price=$_POST["price"];

    $sql="INSERT INTO products(
        name, type_id, origin, specification, price
    ) VALUES (
        '$name', $type_id, '$origin', '$specification', $price
    )
    ";
    if($conn->query($sql)){
        $product_id=$conn->insert_id;
        echo "資料建立成功, 這筆資料的代號是 $product_id";
        // header("location: product_list.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $imageFile = $_FILES["image_src"];
    if($imageFile["error"] == UPLOAD_ERR_OK) {
        $image_src = "upload/img/product/".$product_id.'-'.$imageFile["name"];

        if(move_uploaded_file($imageFile["tmp_name"], $image_src)) {
            $sql = "UPDATE products SET image_src = '$image_src' WHERE `product_id` = $product_id";
            if($conn->query($sql)){
                // echo "upload sucess!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                exit;
            }
        } else {
            echo '移動檔案錯誤';
            exit;
        }
    }

    $conn->close();

    header("location: product_list.php");
?>
