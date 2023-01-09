<?php 
    include './db.php';
    $user = $conn->query('SELECT * FROM user')->fetchAll();
?>
<h2>Danh sách người dùng</h2>
<div class="select">
    <div class="number-of-product">
        <span>Số lượng sản phẩm hiển thị</span>
        <select class="numberShown" name="" id="">
            <option value="5">5</option>
        </select>
    </div>
    <input class="search" type="text" placeholder="Tìm kiếm">
</div>
<br>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên tài khoản</th>
            <th scope="col">Email</th>
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
                ?>
                <tr>
                    <th><?php echo $n['id']?></th>
                    <td><?php echo $n['userName']?></td>
                    <td><?php echo $n['email']?></td>
                    <?php echo $td?>
                    <td>
                        <a href="./admin.php?page=user&action=edit&id=<?php echo $n['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="./admin.php?page=user&action=delete&id=<?php echo $n['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
        <?php   } ;?>   
    </tbody>
</table>
<?php echo '<a href="./admin.php?page=user&action=add" class="text-white btn btn-primary">Thêm mới</a>'?>
<script>
    
</script>