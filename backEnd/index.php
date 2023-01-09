<?php 
    include './db.php';
    $a = $conn->prepare('SELECT * FROM user WHERE userName= :name');
    $a->bindParam(':name', $_SESSION['user']['userName']);
    $a->setFetchMode(PDO::FETCH_ASSOC);
    $a->execute();
    $user = $a->fetch();
?>
<?php 
    if(isset($_SESSION['userName'])){
        echo '<h2> Xin chào '  . $_SESSION['userName'] .  '</h2>';
    }
?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th scope="row">Tên tài khoản</th>
            <td><?php echo  $_SESSION['user']['userName'];?></td>
        </tr>
        <tr>
            <th scope="row">Email</th>
            <td><?php echo  $_SESSION['user']['email'];?></td>
        </tr>
        <tr>
            <th scope="row">Mật khẩu</th>
            <td><?php echo  $_SESSION['user']['passWord'];?></td>
        </tr>
    </tbody>
</table>
<button class="btn btn-primary">Chỉnh sửa</button>