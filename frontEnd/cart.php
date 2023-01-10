<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopCart.css">
    <link rel="stylesheet" href="assets/MoblieCss/mobileCart.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <div class="main">
        <h2>Giỏ hàng của bạn</h2>
        <div class="main-content">
            <div class="col col-8 sm-4 left">
                <div class="left-header mobile-hide">
                    <div class="header-left">
                        <p>Sản phẩm</p>
                    </div>
                    <div class="header-right">
                        <p>Giá</p>
                        <p>Số lượng</p>
                        <p>Tổng giá</p>
                    </div>
                </div>
                <div class="left-content">
                    <?php 
                        // print_r($_SESSION['cart']);
                        $sum = 0;
                        $index = 0;
                        foreach($_SESSION['cart'] as $product_detail){
                            if (!isset($_SESSION['cart'])) {
                                continue;
                            }
                            $sum +=  $product_detail['price'];
                        ?>
                        <div class="left-section">
                            <img class='img'src="<?php echo '../backEnd/'.$product_detail['imagePath'] ?>" alt="">
                            <div class="left-section-content">
                                <div class="product-mainInfo">
                                    <p class="product-title"><?php echo $product_detail['productName']?></p>
                                    <p class="product-des"><?php echo $product_detail['catergoryName']?></p>
                                </div>
                                <div class="product-info-detail">
                                    <p class="product-price"><?php echo $product_detail['price']?></p>
                                    <div class="quantity-bar">
                                        <p class="decreaseBtn" onclick="decreaseNum(this)">-</ơ>
                                        <p>1</p>
                                        <p class="increaseBtn" onclick="increaseNum(this)">+</p>
                                    </div>
                                    <p class="product-total mobile-hide"><?php echo $product_detail['price']?></p>
                                </div>
                                <a href="./cartAction.php?action=delete&index=<?php echo $index?>">
                                    <p class="delete">x</p>
                                </a>
                            </div>
                        </div>
                      <?php 
                            $index++;
                            }
                        ?>
                </div>
            </div>
            <div class="col col-4 sm-4 right">
                <div class="card">
                    <h2>Đơn hàng</h2>
                    <div class="right-section">
                        <p>Tổng tiền</p>
                        <p class="right-money"><?php echo $sum . 'đ' ?></p>
                    </div>
                    <div class="right-section">
                        <p>Vận chuyển</p>
                        <p>Miễn phí</p>
                    </div>
                    <p class="coupon">Thêm mã giảm giá</p>
                    <div class="right-section">
                        <p>Tổng tiền</p>
                        <p class="right-money"><?php echo $sum . 'đ' ?></p>
                    </div>
                    <a href="">
                        <button class="btn">Thanh toán</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include 'assets/include/footer.php'?>
</body>
</html>