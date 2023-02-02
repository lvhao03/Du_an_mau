<?php 
    include './db.php';
    $user_list = $conn->query('SELECT * FROM user LIMIT 5')->fetchAll();
?>
<h2>Danh sách người dùng</h2>
<div class="select">
    <div>
        <span>Lọc theo</span>
        <select class="filter-user-role" name="" id="">
            <option value="0">Tất cả</option>
            <option value="admin">Admin</option>
            <option value="Khách hàng">Khách hàng</option>
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
            foreach ($user_list as $n){
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
      $(document).ready(function(){
        let filterBar = $(".filter-user-role");
        let tbody = $('tbody');

        // Lọc theo admin, khách hàng
        filterBar.change(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    userRole: filterBar.val(),
                    action: 'filter_user_role',
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    renderUserSection(result);
                }
            })
        })

        // Tìm kiwsm
        let searchBar = $('.search');
        searchBar.keyup(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    keyWord: searchBar.val(),
                    action: 'search_query',
                    tableName: "user"
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    renderUserSection(result);
                }
            })
        })

        function renderUserSection(userList){
            let html = '';
            userList.forEach(user => {
                let role = changeRoleBackGround(user['userRole']);
                html += `<tr>
                            <th scope="row"> ${user['id']}</th>
                            <td>${user['userName']}</td>
                            <td>${user['email']}</td>
                            ${role}
                            <td>
                                <a href="./admin.php?page=user&action=edit&id=${user['id']}"><i class="fa-solid fa-pen-to-square"></i></a> 
                                <a href="./admin.php?page=user&action=delete&id=${user['id']}"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>`;
            });
            tbody.html(html);
        }
        
        function changeRoleBackGround(role){
            if (role == 'admin') {
                return `<td><span class="admin">${role}</span></td>`;
            }
            return `<td><span class="user">${role}</span></td>`;
        }
    })
        
</script>