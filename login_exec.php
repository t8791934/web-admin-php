<!-- 檢查登入資料 -->
<?php
    session_start();

    require "utils/db_connect_mysqli.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($sql);
    // echo $result->num_rows;

    // 資料輸入正確也就是num_row>0會轉往dashboard頁面, 如輸入錯誤則會轉往login頁面
    if ($result->num_rows > 0) {
        // 到資料庫取得session後user的名字email和年齡的陣列資料
        $row = $result->fetch_assoc();

        $_SESSION["login"]["username"] = $row["username"];
        $_SESSION["login"]["name"] = $row["name"];

        unset($_SESSION["error"]);
        header("location: index.php");
    } else {
        // 登入資訊如果輸入錯誤,顯示以下訊息給使用者
        $_SESSION["error"]["message"] = "您輸入的帳號或密碼錯誤";

        // error次數往上加總,顯示加總次數在介面上
        if (isset($_SESSION["error"]["times"])) {
            $_SESSION["error"]["times"]++;
        } else {
            $_SESSION["error"]["times"] = 1;
        }

        header("location: login.php");
    }
?>
