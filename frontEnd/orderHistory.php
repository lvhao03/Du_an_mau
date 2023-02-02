<?php
    session_start();
    include '../backEnd/db.php';

    // Lấy danh sách đơn hàng của user
    $stmt = $conn->prepare('SELECT * FROM bill WHERE bill.userID = ? ');
    $stmt->execute([$_SESSION['user']['id']]);
    $order_list = $stmt->fetchAll();

    // Đếm số lượng sản phẩm của mỗi đơn hàng
    $sql_2 = 'SELECT count(*) as num FROM bill_detail join bill 
          ON bill_detail.bill_id = bill.id WHERE bill.userID = ? GROUP BY bilL_detail.bill_id';
    $stmt_2 = $conn->prepare($sql_2);
    $stmt_2->execute([$_SESSION['user']['id']]);
    $number_of_product = $stmt_2->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopOrderHistory.css">
    <!-- <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <div class="main">
        <h2>Lịch sử mua hàng</h2>
        <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Mã đơn hàng</th>
                <th scope="col">Ngày mua</th>
                <th scope="col">Số sản phẩm mua</th>
                <th scope="col">Tổng tiền thanh toán</th>
                <th scope="col">Tình trạng</th>
                <th scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
               function change_status_back_ground($status){
                if ($status == 'Đang xử lý') {
                    return '<span class="status status-xuly">'.$status.'</span>';
                }
                if ($status == 'Hoàn tất') {
                    return '<span class="status status-done">'.$status.'</span>';
                }
                if ($status == 'Đã hủy') {
                    return '<span class="status status-cancel">'.$status.'</span>';
                }
                }
                $i = 0;
                foreach ($order_list as $order){
                    $status = change_status_back_ground($order['status']);
                    ?>
                    <tr>
                        <th><?php echo $order['id']?></th>
                        <td><?php echo $order['date']?></td>
                        <td><?php echo $number_of_product[$i]['num']?></td>
                        <td><?php echo $order['total_money']?></td>
                        <td><?php echo $status ?></td>
                        <td>
                            <a href="./orderDetail.php?id=<?php echo $order['id']?>">Xem chi tiết</a>
                        </td>
                    </tr>
            <?php  
                $i++;
            } ;?>
        </tbody>
        </table>
    </div>
    <?php include 'assets/include/footer.php'?>
</body>
</html>