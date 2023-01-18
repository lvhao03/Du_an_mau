<?php 
    include './db.php';
    $stmt = $conn->prepare('SELECT bill.name , bill.status, bill.total_money, product.imagePath, product.productName, product.price , bill_detail.bill_id, bill_detail.num FROM bill_detail JOIN product 
                            ON product.id = bill_detail.product_ID JOIN bill
                            ON bill_detail.bill_id = bill.id
                            WHERE bill_detail.bill_id = ?');
    $stmt->execute([$_GET['id']]);
    $order = $stmt->fetchAll();
    // Lấy số lượng sản phẩm
    $sql_2 = 'SELECT count(*) as num FROM bill_detail WHERE bill_detail.bill_id = ?';
    $stmt_2 = $conn->prepare($sql_2);
    $stmt_2->execute([$_GET['id']]);
    $arr = $stmt_2->fetch();
?>
<h2>Hóa đơn chi tiết</h2>

<div class="order-detail">
    <div class="left">
        <p>Mã đơn hàng: <?php echo $_GET['id']?></ưp>
        <p>Người mua: <?php echo $order[0]['name']?></p>
        <p>Tình trạng: 
            <select name="<?php echo $_GET['id']?>" class="selectStatus" id="">
                <option value="<?php echo $order[0]['status']?>"><?php echo $order[0]['status']?></option>
            <?php 
                $statusList = ['Đang xử lý', 'Hoàn tất', 'Đã hủy' ];
                for ($i = 0 ; $i < count($statusList) ; $i++) {
                    if ($order[0]['status'] == $statusList[$i]) {
                        continue;
                    }
            ?>
                <option value="<?php echo $statusList[$i]?>"><?php echo $statusList[$i]?></option>
                <?php }?>
            </select>
            <button class="btn btn-primary">Cập nhật đơn hàng</button>
        </p>
    </div>
    <div class="right">
        <p>Tổng sản phẩm mua: <?php echo $arr['num']?></p>
        <p>Tổng tiền thanh toán: <?php echo $order[0]['total_money']?></p>
    </div>
</div>
<br>
<h3>Danh sách mua hàng</h3>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Giá cả</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($order as $n){
                ?>
                <tr>
                    <th><?php echo $n['bill_id']?></th>
                    <td>
                        <img src="<?php echo $n['imagePath']?>" alt="">
                    </td>
                    <td><?php echo $n['productName']?></td>
                    <td><?php echo $n['num']?></td>
                    <td><?php echo $n['price']?></td>
                </tr>
        <?php   } ;?>   
    </tbody>
</table>
<a href="http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=order&action=show">
    <button class="btn btn-primary">Xem danh sách đơn hàng</button>
</a>
<script>
    let status = $('.selectStatus');
    $(document).ready(function(){
        status.change(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/backEnd/order/update.php',
                data: {
                    status: status.val(),
                    id: status.attr('name')
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                }
            })
        })
    })
</script>