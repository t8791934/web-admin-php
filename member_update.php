<?php
    require 'includes/authorize.php';
    require "utils/db_connect_mysqli.php";

    $avatarFile = $_FILES["avatar_image_file"];
    $member_id=$_POST["member_id"];
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
        $avatarUpdateString = '';
    } else {
        $avatarUpdateString = "avatar_image_src = '$avatar_image_src',";
    }

    if ($birth_date == '') {
        $birthDateValue = 'NULL';
    } else {
        $birthDateValue = "'$birth_date'";
    }

    $sql = "UPDATE members SET
        username = '$username',
        password = '$password',
        name = '$name',
        gender = '$gender',
        $avatarUpdateString
        birth_date = $birthDateValue,
        address = '$address',
        phone_number = '$phone_number',
        email = '$email'
    WHERE member_id = $member_id";

    if($conn->query($sql) === TRUE) {
        // echo "更新成功";
    } else {
        echo "更新資料錯誤: " . $conn->error;
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
        <title>修改中... - <?= $websiteTitle ?></title>
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
                            title: '修改成功！',
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
