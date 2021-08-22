<!-- 輸入登入資料 -->
<?php
    session_start();

    if(isset($_SESSION["login"])){
        header("Location: index.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>登入管理系統</title>
    </head>
    <body style="background-color: #eee;">
        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <div class="card px-4 py-5" style="width: 400px;">
                <h1 class="text-center h3 mb-5">登入管理系統</h1>
                <?php if(isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"] > 5): ?>
                    <!-- 登入次數太多次將顯示以下訊息 -->
                    <div>
                        您登入的錯誤次數太多,請稍後再回來使用正確的帳號密碼登入
                    </div>
                <?php else: ?>
                    <form action="login_exec.php" method="post">
                        <div class="form-group">
                            <label>帳號</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>密碼</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <!-- 將輸入錯誤訊息顯示在登入頁面上 -->
                        <?php if(isset($_SESSION["error"])): ?>
                            <div class="text-danger">
                                <?= $_SESSION["error"]["message"] ?>
                                <!-- 顯示登入錯誤的次數 -->
                                <div>您已登入錯誤 <?= $_SESSION["error"]["times"] ?> 次</div>
                            </div>
                        <?php endif; ?>
                        <button class="btn btn-info btn-block mt-5">登入</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
