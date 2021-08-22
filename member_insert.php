<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $avatarFile = $_FILES["avatar_image_file"];

    $username=$_POST["username"];
    $password=$_POST["password"];
    $name=$_POST["name"];
    $gender=$_POST["gender"];
    $avatar_image_src="upload/img/".$username.'-'.$avatarFile["name"];
    $birth_date=$_POST["birth_date"];
    $address=$_POST["address"];
    $phone_number=$_POST["phone_number"];
    $email=$_POST["email"];

    if ($avatarFile['error'] !== UPLOAD_ERR_OK) {
        $avatarValue = 'NULL';
    } else {
        $avatarValue = "'$avatar_image_src'";
    }

    if ($birth_date == '') {
        $birthDateValue = 'NULL';
    } else {
        $birthDateValue = "'$birth_date'";
    }

    $sql="INSERT INTO members(
        username, password, name, gender, avatar_image_src, birth_date, address, phone_number, email
    ) VALUES (
        '$username', '$password', '$name', '$gender', $avatarValue, $birthDateValue, '$address', '$phone_number', '$email'
    )";

    if($conn->query($sql)){
        // $last_id=$conn->insert_id;
        // echo "新資料建立成功, 這筆資料的代號是 $last_id";
        // header("location: member_list.php"); //操作完資料庫 導回顯示結果頁面
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    if($avatarFile["error"] === UPLOAD_ERR_OK) {
        if(move_uploaded_file($avatarFile["tmp_name"], $avatar_image_src)) {
            // echo "上傳成功";
        } else {
            echo "上傳資料錯誤!";
            exit;
        }
    }

    $conn->close(); //close database
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'includes/head.php'; ?>
        <!-- head-start -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- head-end -->
        <title>建立中... - <?= $websiteTitle ?></title>
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
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: '新增成功！',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(function () {
                            window.location.replace(document.referrer);
                        });
                    </script>
                    <!-- content-end -->
                </main>
                <?php require 'includes/footer.php'; ?>
            </div>
        </div>
    </body>
</html>
