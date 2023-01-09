<?php 
    session_start();
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../backEnd/db.php';
        
        $sql = 'SELECT * FROM user WHERE id = ? AND passWord = ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET['id'], $_POST['oldpassWord']]);
        if ($stmt->rowCount() > 0) {
            $sucess = '<script> alert("Thanh cong"); </script>';
            $sql_2 = 'UPDATE user SET passWord = ? WHERE id = ?';
            $stmt_2 = $conn->prepare($sql_2);
            $stmt_2->execute([$_POST['newpassWord'], $_GET['id']]);
        } else {
            $error = '<p class="red">Sai mật khẩu</p>';
        }
    }
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
            <h2>Đổi mật khẩu</h2>
            <form action="#" method="POST">
                <label for="email">
                    <p>Nhập mật khẩu cũ</p>
                    <input id='email'type="password" name='oldpassWord' required placeholder="Nhập mật khẩu cũ">
                    <?php  if (isset($error)) echo $error;?>
                    <?php  if (isset($sucess)) echo $sucess;?>
                </label>
                <label for="email">
                    <p>Nhập mật khẩu mới</p>
                    <input id='email'type="password" name='newpassWord' required placeholder="Nhập mật khẩu mới">
                </label>
                <a href="">
                    <button type='submit' class="btn">Đổi</button>
                </a>
            </form>
        </div>
    </div>
    <?php include 'assets/include/footer.php'?>
</body>
</html>