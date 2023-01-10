<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $a = $conn->prepare('UPDATE user SET userName=:name, email=:email, passWord=:pass, userRole=:role WHERE user.id= :id');
        $a->bindParam(':id', $_GET['id']);
        $a->bindParam(':name', $_POST['userName']);
        $a->bindParam(':pass', $_POST['passWord']);
        $a->bindParam(':email', $_POST['email']);
        $a->bindParam(':role', $_POST['userRole']);
        if($a->execute()){
            echo 'Thêm thành công';
        };
        header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=user&action=show');
    } else {
        $a = $conn->prepare('SELECT * FROM user WHERE id= :id');
        $a->bindParam(':id', $_GET['id']);
        $a->setFetchMode(PDO::FETCH_ASSOC);
        $a->execute();
        $user = $a->fetch();
    }
?>
<h2>Chỉnh sửa người dùng</h2>
<form class="form" method="POST">
    <div class="form-group">
        <label for="userName">Tên người dùng</label>
        <input type="text" name='userName' class="form-control" id="userName" value="<?php echo $user['userName']; ?>" placeholder="Nhập tên người dùng">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text"name='email' class="form-control" id="email" value="<?php echo $user['email']; ?>" placeholder="Nhập email">
    </div>
    <div class="form-group">
        <label for="passWord">Mật khẩu</label>
        <input type="text" name='passWord' class="form-control" id="passWord" value="<?php echo $user['passWord']; ?>"  placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <label for="role">Vai trò</label>
        <select class="form-control" name="userRole" id="">
            <option value="Khách hàng">Khách hàng</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type='submit' class="btn btn-primary">Chỉnh sửa</button>
    <a href="./admin.php?page=user&action=show" class="text-white btn btn-primary">Xem danh sách</a>
</form>
