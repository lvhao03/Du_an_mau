<?php 
    include './db.php';
    $user = $conn->query('SELECT * FROM bill LIMIT 5')->fetchAll();
?>
<h2>Danh sách hóa đơn</h2>
<div class="select">
    <div class="status-list">
        <input value="all" checked name= "status" type="radio" id="all">
        <label for="all">Tất cả</label> 
        <input value="Đang xử lý" name= "status" type="radio" id="waiting">
        <label for="waiting">Đang xử lý</label> 
        <input value="Hoàn tất" name= "status" type="radio" id="done">
        <label for="done">Hoàn tất</label> 
        <input value="Đã hủy" name= "status" type="radio" id="delete">
        <label for="delete">Đã hủy</label> 
    </div>
    <input class="search" type="text" placeholder="Tìm kiếm">
</div>
<br>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Mã đơn hàng</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Tổng tiền</th>
            <th scope="col">Ngày mua</th>
            <th scope="col">Tình trạng</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($user as $n){
                ?>
                <tr>
                    <th><?php echo $n['id']?></th>
                    <td><?php echo $n['name']?></td>
                    <td><?php echo $n['address']?></td>
                    <td><?php echo $n['total_money']?></td>
                    <td><?php echo $n['date']?></td>
                    <td>
                        <span class="status"><?php echo $n['status']?></span></td>
                    <td>
                        <a href="./admin.php?page=order&action=show_detail&id=<?php echo $n['id']?>"><i class="fa-solid fa-plus"></i></a>
                    </td>
                </tr>
        <?php   } ;?>   
    </tbody>
</table>
<script>
      $(document).ready(function(){
        let input = $(".number-shown");
        let tbody = $('tbody');
        let checkBoxes = $('input[name="status"]');

        let statues = $('.status');
        statues.each(function(){
            let statusList = ['Đang xử lý', 'Hoàn tất', 'Đã hủy' ];
            let classList = ['status-xuly', 'status-done', 'status-cancel' ];
            let i = 0;
            $.each(statusList, (index, state) => {
                if ($(this).text()  ==  state){
                    $(this).addClass(classList[index]);
                }
                i++
            })
        })

        checkBoxes.click(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    status: $('input[name="status"]:checked').val(),
                    action: 'filter_order_status'
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    let html = '';
                    $.each(result, (index , order) => {
                        html += ` <tr>
                                    <th scope="row"> ${order['id']}</th>
                                    <td>${order['name']}</td>
                                    <td>${order['address']}</td>
                                    <td>${order['total_money']}</td>
                                    <td>${order['date']}</td>
                                    <td><span class="status">${order['status']}</span></td>
                                    <td>
                                        <a href="./admin.php?page=order&action=show_detail&id=${order['id']}"><i class="fa-solid fa-plus"></i></a>
                                    </td>
                                </tr>`;
                    })
                    tbody.html(html);
                    $(document).on('mouseover', 'body', function(){
                        let status = $('.status');
                        status.each(function(){
                            let statusList = ['Đang xử lý', 'Hoàn tất', 'Đã hủy' ];
                            let classList = ['status-xuly', 'status-done', 'status-cancel' ];
                            let i = 0;
                            $.each(statusList, (index, state) => {
                                if ($(this).text()  ==  state){
                                    $(this).addClass(classList[index]);
                                }
                                i++
                            })
                        })
                    })
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