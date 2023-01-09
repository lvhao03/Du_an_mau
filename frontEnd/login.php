<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopLogin.css">
    <link rel="stylesheet" href="assets/MoblieCss/mobileLogin.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <div class="main">
        <img src="./assets/images/Group 150.png" alt="">
        <div class="card">
            <h2>Đăng nhập</h2>
            <form action="../backEnd/login.php" method="GET">
                <label for="username">
                    <p>Tên tài khoản</p>
                    <input id='username'type="text" name='userName' required placeholder="Điền tên tài khoản">
                </label>
                <label for="password">
                    <p>Mật khẩu</p>
                    <input id='password'type="password" name='passWord' required placeholder="Điền mật khẩu">
                </label>
                <div class="card-section">
                    <div class="card-checkbox">
                        <input type="checkbox">
                        <p>Nhớ mật khẩu</p>
                    </div>
                    <a href="./forgotpassword.php" class="link">Quên mật khẩu ?</a>
                </div>
                <a href="">
                    <button type='submit' class="btn">Đăng nhập</button>
                </a>
            </form>
            <div class="card-section">
                <p>Chưa có mật khẩu ?</p>
                <a href="./register.php" class="link">Đăng ký</a>
            </div>
        </div>
    </div>
    <?php include 'assets/include/footer.php'?>
</body>
</html>