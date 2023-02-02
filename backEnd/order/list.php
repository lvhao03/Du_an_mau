<?php 
    include './db.php';
    $order_list = $conn->query('SELECT * FROM bill LIMIT 5')->fetchAll();
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
            function changeStateBackGround($state){
            if ($state == 'Đang xử lý') {
                return '<span class="status status-xuly">'.$state.'</span>';
            }
            if ($state == 'Hoàn tất') {
                return '<span class="status status-done">'.$state.'</span>';
            }
            if ($state == 'Đã hủy') {
                return '<span class="status status-cancel">'.$state.'</span>';
            }
            }

            foreach ($order_list as $order){
                $state = changeStateBackGround($order['status']);
                ?>
                <tr>
                    <th><?php echo $order['id']?></th>
                    <td><?php echo $order['name']?></td>
                    <td><?php echo $order['address']?></td>
                    <td><?php echo $order['total_money']?></td>
                    <td><?php echo $order['date']?></td>
                    <td>
                        <?php echo $state; ?>
                    <td>
                        <a href="./admin.php?page=order&action=show_detail&id=<?php echo $order['id']?>"><i class="fa-solid fa-plus"></i></a>
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
                    renderOrderSection(result);
                }
            })
        })

        function changeStateBackGround(state){
            if (state == 'Đang xử lý') {
                return `<span class="status status-xuly">${state}</span></td>`;
            }
            if (state == 'Hoàn tất') {
                return `<span class="status status-done">${state}</span></td>`;
            }
            if (state == 'Đã hủy') {
                return `<span class="status status-cancel">${state}</span></td>`;
            }
        }

        function renderOrderSection(orderList){
            let html = '';
            orderList.forEach(order => {
                let state = changeStateBackGround(order['status']);
                html += ` <tr>
                            <th scope="row"> ${order['id']}</th>
                            <td>${order['name']}</td>
                            <td>${order['address']}</td>
                            <td>${order['total_money']}</td>
                            <td>${order['date']}</td>
                            <td>
                                ${state}
                            <td>
                                <a href="./admin.php?page=order&action=show_detail&id=${order['id']}"><i class="fa-solid fa-plus"></i></a>
                            </td>
                        </tr>`;
            })
            tbody.html(html);
        }   
        // let searchBar = $('.search');
        // searchBar.keyup(function(){
        //     $.ajax({
        //         url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
        //         data: {
        //             keyWord: searchBar.val(),
        //             action: 'search_query',
        //             tableName: "user"
        //         },
        //         type: 'POST',
        //         dataType: 'json',
        //         success: function(result){
        //             let html = '';
        //             $.each(result, (index , user) => {
        //                 let td = '';
        //                 if (user['userRole'] == 'admin') {
        //                     td = `<td><span class="admin">${user['userRole']}</span></td>`;
        //                 } else {
        //                     td = `<td><span class="user">${user['userRole']} </span></td>`;
        //                 }
        //                 html += `<tr>
        //                             <th scope="row"> ${user['id']}</th>
        //                             <td>${user['userName']}</td>
        //                             <td>${user['email']}</td>
        //                             ${td}
        //                             <td>
        //                                 <a href="./admin.php?page=user&action=edit&id=${user['id']}"><i class="fa-solid fa-pen-to-square"></i></a> 
        //                                 <a href="./admin.php?page=user&action=delete&id=${user['id']}"><i class="fa-solid fa-trash"></i></a>
        //                             </td>
        //                         </tr>`;
        //             })
        //             tbody.html(html);
        //         }
        //     })
        // })
    })
</script>