<?php
    session_start();
    include '../backEnd/db.php';
    $bill_detail = get_bill_detail_info($conn);
    $bill_product_list = get_bill_products($conn);
    $total_product = get_total_product_buy($conn);

    function get_bill_detail_info($conn){
        $stmt = $conn->prepare('SELECT bill.name , bill.total_money, bill.id,
                                bill.status FROM bill WHERE bill.id = ?');
        $stmt->execute([$_GET['id']]);
        return $stmt->fetch();
    }

    function get_bill_products($conn){
        $stmt = $conn->prepare('SELECT product.imagePath, product.productName, 
                                product.price , bill_detail.bill_id, bill_detail.num FROM bill_detail JOIN product 
                                ON product.id = bill_detail.product_ID JOIN bill
                                ON bill_detail.bill_id = bill.id
                                WHERE bill_detail.bill_id = ?');
        $stmt->execute([$_GET['id']]);
        return $stmt->fetchAll();
    }

    function get_total_product_buy($conn){
        $stmt = $conn->prepare('SELECT count(id) as total_product FROM bill_detail WHERE bill_detail.bill_id = ? GROUP BY bill_detail.bill_id');
        $stmt->execute([$_GET['id']]);
        return $stmt->fetch();
    }
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
                <p>Người mua: <?php echo $bill_detail['name']?></p>
                <p>Tình trạng: <?php echo $bill_detail['status']?></p>
            </div>
            <div class="right">
                <p>Tổng danh sách sản phẩm mua: <?php echo $total_product['total_product']?></p>
                <p>Tổng tiền thanh toán: <?php echo $bill_detail['total_money']?></p>
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
                <th scope="col">Tổng giá</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($bill_product_list as $product){
                    $total_price = $product['num'] * $product['price'];
                    ?>
                    <tr>
                        <th><?php echo $product['bill_id']?></th>
                        <td>
                            <img src="../backEnd/<?php echo $product['imagePath']?>" alt="">
                        </td>
                        <td><?php echo $product['productName']?></td>
                        <td><?php echo $product['num']?></td>
                        <td><?php echo $product['price']?></td>
                        <td><?php echo $total_price?></td>
                    </tr>
            <?php   } ;?>   
        </tbody>
    </table>
    </div>
    <?php include 'assets/include/footer.php'?>
</body>
</html>