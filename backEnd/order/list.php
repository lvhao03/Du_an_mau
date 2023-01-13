<?php 
    include './db.php';
    $user = $conn->query('SELECT * FROM user LIMIT 5')->fetchAll();
?>
<h2>Danh sách hóa đơn</h2>
<div class="select">
    <div class="status-list">
        <!-- <select class="numberShown" name="" id="">
            <option value="5">5</option>
            <option value="10">10</option>
        </select> -->
        <input name= "status" type="radio" id="all">
        <label for="all">Tất cả</label> 
        <input name= "status" type="radio" id="waiting">
        <label for="waiting">Chờ xác nhận</label> 
        <input name= "status" type="radio" id="ship">
        <label for="ship">Đang vận chuyển</label> 
        <input name= "status" type="radio" id="done">
        <label for="done">Hoàn thành</label> 
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
<script>
      $(document).ready(function(){
        let input = $(".number-shown");
        let tbody = $('tbody');

        // Giới hạn số lượng hiển thị
        input.change(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    number: input.val(),
                    action: 'list_query_record',
                    type: "product"
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    let html = '';
                    console.log(result['catergoryName']);
                    $.each(result, (index , product) => {
                        html += ` <tr>
                                    <th scope="row"> ${product['id']}</th>
                                    <td><img src="${product['imagePath']}" class="rounded" alt=""></td>
                                    <td>${product['productName']}</td>
                                    <td>${product['catergoryName']}</td>
                                    <td>${product['price']}</td>
                                    <td>${product['des']}</td>
                                    <td>
                                        <a href="./admin.php?page=product&action=edit&id=${product['id']}"><i class="fa-solid fa-pen-to-square"></i></a> 
                                        <a href="./admin.php?page=product&action=delete&id=${product['id']}"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>`;
                    })
                    tbody.html(html);
                }
            })
        })

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
                    let html = '';
                    $.each(result, (index , user) => {
                        let td = '';
                        if (user['userRole'] == 'admin') {
                            td = `<td><span class="admin">${user['userRole']}</span></td>`;
                        } else {
                            td = `<td><span class="user">${user['userRole']} </span></td>`;
                        }
                        html += `<tr>
                                    <th scope="row"> ${user['id']}</th>
                                    <td>${user['userName']}</td>
                                    <td>${user['email']}</td>
                                    ${td}
                                    <td>
                                        <a href="./admin.php?page=user&action=edit&id=${user['id']}"><i class="fa-solid fa-pen-to-square"></i></a> 
                                        <a href="./admin.php?page=user&action=delete&id=${user['id']}"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>`;
                    })
                    tbody.html(html);
                }
            })
        })
    })
</script>