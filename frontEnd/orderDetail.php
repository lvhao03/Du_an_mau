<?php
   session_start();
   include '../backEnd/db.php';

   // Lấy danh sách sản phảm mà đơn hàng đã đặt
   $stmt = $conn->prepare('SELECT bill.name , bill.total_money, product.imagePath, product.productName, product.price , bill_detail.bill_id, bill_detail.num FROM bill_detail JOIN product 
            ON product.id = bill_detail.product_ID JOIN bill
            ON bill_detail.bill_id = bill.id
            WHERE bill_detail.bill_id = ?');
   $stmt->execute([$_GET['id']]);
   $order = $stmt->fetchAll();

   // Lấy số lượng sản phẩm
   $sql_2 = 'SELECT count(*) as num FROM bill_detail join bill 
            ON bill_detail.bill_id = bill.id WHERE bill.userID = ? AND  bill_detail.bill_id = ?';
   $stmt_2 = $conn->prepare($sql_2);
   $stmt_2->execute([$_SESSION['user']['id'] , $_GET['id']]);
   $numberOfProduct= $stmt_2->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopOrderHistory.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <div class="main">
        <h2>Đơn hàng chi tiết</h2>
        <div class="order-detail">
            <div class="left">
                <p>Mã đơn hàng: <?php echo $_GET['id']?></ưp>
                <p>Người mua: <?php echo $order[0]['name']?></p>
                <p>Tình trạng: Chờ xác nhận</p>
            </div>
            <div class="right">
                <p>Tổng sản phẩm mua: <?php echo $numberOfProduct['num']?></p>
                <p>Tổng tiền thanh toán: <?php echo $order[0]['total_money']?></p>
            </div>
        </div>

        <h3>Đơn hàng</h3>
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
                            <img src="../backEnd/<?php echo $n['imagePath']?>" alt="">
                        </td>
                        <td><?php echo $n['productName']?></td>
                        <td><?php echo $n['num']?></td>
                        <td><?php echo $n['price']?></td>
                    </tr>
            <?php   } ;?>   
        </tbody>
    </table>
    </div>
    <?php include 'assets/include/footer.php'?>
</body>
</html>