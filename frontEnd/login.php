<?php 
    session_start();
    include '../backEnd/db.php';
    include '../backEnd/lib.php';

    if (isset($_POST['user_name']) && isset($_POST['pass_word'])){
        $user = get_user($_POST['user_name'], $_POST['pass_word']) ?? null;
        if (!$user) {
            $error = '<span class="red">Tên đăng nhập hoặc mật khẩu bị sai</span>';
        } else {
            storeUserInSession($user);        
            redirect_user($user);        
        }
    }

    function redirect_user($user){
        if (isAdmin($user)) {
            return header('Location: ../backEnd/admin.php?page=index');
        }
        return header('Location: ../frontEnd/index.php');
    }

    function isAdmin($user){
        if ($user['userRole'] == 'admin') {
            return true;
        }
        return false;
    }


    function get_user($user_name, $user_password){
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM user WHERE userName = ? AND passWord = ?');
        $stmt->execute([$user_name,$user_password]);
        $user = $stmt->fetch();
        return $user;
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
            <h2>Đăng nhập</h2>
            <form action="" method="POST">
                <label for="username">
                    <p>Tên tài khoản</p>
                    <input id='username'type="text" name='user_name' required placeholder="Điền tên tài khoản">
                    <?php echo $error ?? ''?>
                </label>
                <label for="password">
                    <p>Mật khẩu</p>
                    <input id='password'type="password" name='pass_word' required placeholder="Điền mật khẩu">
                    <?php echo $error ?? ''?>
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