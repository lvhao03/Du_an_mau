<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $stmt = $conn->prepare("INSERT INTO user(userName,email, passWord, userRole) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['userName'],$_POST['email']],$_POST['passWord'], $_POST['userRole']);
        header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=user&action=show');
    }
?>

<h2>Thêm mới người dùng</h2>
<form action="" class="form" method="POST">
    <div class="form-group">
        <label for="formGroupExampleInput">Tên người dùng</label>
        <input type="text" required name="userName" class="form-control" id="formGroupExampleInput" placeholder="Nhập tên người dùng">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Email</label>
        <input type="text" required name="email" class="form-control" id="formGroupExampleInput2" placeholder="Nhập email">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Mật khẩu</label>
        <input type="number" required name="passWord"class="form-control" id="formGroupExampleInput2" placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Vai trò</label>
        <input type="text" required name="userRole"class="form-control" id="formGroupExampleInput2" placeholder="Nhập vai trò">
    </div>
    <button type='submit' class="btn btn-primary">Thêm</button>
</form>
