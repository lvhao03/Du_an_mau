<?php 
    session_start();
    include '../backEnd/db.php';
    $user = get_user($conn);

    function get_user($conn){
        $stmt = $conn->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$_SESSION['user']['id']]);
        return $stmt->fetch();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopUser.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <div class="flex">
        <img class="user_avatar1" src="<?php echo '../backEnd/' . $user['imagePath']?>" alt="">
        <form class="form" action="../backEnd/update_user.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="userName">Tên người dùng</label>
                <input type="text" name='userName' class="form-control" id="userName" value="<?php echo $user['userName']; ?>" placeholder="Nhập tên người dùng">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text"name='email' class="form-control" id="email" value="<?php echo $user['email']; ?>" placeholder="Nhập email">
            </div>
            <div class="form-group">
                <label for="file">Ảnh đại diện</label>
                <input type="file" name='file' class="form-control" id="file">
            </div>
            <button type='submit' class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
    <?php include 'assets/include/footer.php'?>

</body>
</html>