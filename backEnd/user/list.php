<?php 
    include './db.php';
    $user = $conn->query('SELECT * FROM user')->fetchAll();
?>
<h2>Danh sách người dùng</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên tài khoản</th>
            <th scope="col">Email</th>
            <th scope="col">Mật khẩu</th>
            <th scope="col">Vai trò</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($user as $n){
                if ($n['userRole'] == 'admin') {
                    $td = '<td><span class="admin">'. $n['userRole'] .'</span></td>';
                } else {
                    $td = '<td><span class="user">'. $n['userRole'] .'</span></td>';
                }
                echo '<tr>'.
                        '<th scope="row">'. $n['id'] .'</th>'.
                        '<td>'. $n['userName'] .'</td>'.
                        '<td>'. $n['email'] .'</td>'.
                        '<td>'. $n['passWord'] .'</td>'.
                        $td.
                        '<td>'.
                            '<a href="./admin.php?page=user&action=edit&id=' .$n['id']. '"'. 'class="text-white btn btn-primary">Chỉnh sửa</a>'.
                            '<a href="./admin.php?page=user&action=delete&id=' .$n['id']. '"' .'class="text-white btn btn-danger">Xóa</a>'
                        .'</td>'.
                    '</tr>';
            }
        ?>
    </tbody>
</table>
<?php echo '<a href="./admin.php?page=user&action=add" class="text-white btn btn-primary">Thêm mới</a>'?>