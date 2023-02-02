<?php
   session_start();

   function render_product_list($product_list){
        foreach($product_list as $product){
            $imagePath = '../backEnd/' .$product['imagePath'] ;
            $price = $product['price'] . ' đ';
            echo '<div class="col col-3 sm-2">'.'
                        <div class="card">'.
                            '<img src="'. $imagePath.'" alt="">
                            <h2 class="product-title">'.$product['productName'].'</h2>
                            <div class="product-words">
                                <p class="product-des">'.$product['des'].'</p>
                                <p class="product-price">'.$price.'</p>
                            </div>
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star not-checked"></span>
                                <span class="fa fa-star not-checked"></span>
                            </div>
                            <a href="./product-detail.php?id='.$product['id'].'" class="btn-link">
                                <button class="btn">Mua ngay</button>
                            </a>
                        </div>
                </div>';
        }
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
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopHome.css">
    <link rel="stylesheet" href="assets/MoblieCss/mobileHome.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <!-- Banner -->
    <div class="banner">
        <div class="slider">
            <img class='mainImage' src="https://img.freepik.com/premium-vector/summer-sale-green-white-background-professional-banner-multipurpose-design-free-vector_1340-20165.jpg?w=2000" alt="">
            <div class="double-btn mobile-hide">
                <button class="pre"><i class="fas fa-arrow-left"></i></button>
                <button class="next"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div class="dots">
            <div class="dot dot-active" onclick="changeImageByDot(0, this)"></div>
            <div class="dot" onclick="changeImageByDot(1, this)"></div>
            <div class="dot" onclick="changeImageByDot(2, this)"></div>
            <div class="dot" onclick="changeImageByDot(3, this)"></div>
        </div>
    </div>



    <!-- New arrivals section -->
    <div class="arrivals-section">
        <h2>Sản phẩm mới nhất</h2>
        <div class="grid">
            <?php 
                include '../backEnd/db.php';
                $result_1 = $conn->query('SELECT * FROM product ORDER BY id DESC LIMIT 4')->fetchAll();
                foreach($result_1 as $product){
                    $imagePath = '../backEnd/' . $product['imagePath'];
            ?>
            <div class="grid-item large">
                <img src="<?php echo $imagePath?>" alt="">
                <div class="large-content">
                    <div class="large-header">
                        <h2><?php echo $product['productName']?></h2>
                        <p class="price"><?php echo $product['price']?></p>
                    </div>
                    <div class="large-body">
                        <div class="stars">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star not-checked"></span>
                            <span class="fa fa-star not-checked"></span>
                        </div>
                        <div class="large-des mobile-hide">
                            <?php echo $product['des']?>
                        </div>
                        <a href="./product-detail.php?id=<?php echo $product['id']?>">
                            <button class="btn large-btn mobile-hide">Mua ngay</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
    <!-- Page info section -->
    <div class="page-info-background">
        <div class="page-info">
            <div class="page-detail">
                <h2>Fashion style</h2>
                <p>Vì sao nên lựa chọn chúng tôi</p>
                <ul class="page-detail-list">
                    <li>
                        <b>Miễn phí vận chuyển</b>
                        Miễn phí khi dưới 5km
                    </li>
                    <li>
                        <b>Chất lượng sản phẩm</b>
                        Chất lượng sản phẩm luôn tốt nhất
                    </li>
                    <li>
                        <b>Dịch vụ hỗ trợ</b>
                        Chúng tôi có nhiều chính sách hỗ trợ cho khách hàng
                    </li>
                </ul>
                <a href="" class="btn-link">
                    <button class="btn">Tìm hiểu thêm</button>
                </a>
            </div>
            <img src="https://thumbs.dreamstime.com/b/portrait-young-asian-woman-beautiful-girl-wear-yellow-t-shirt-background-copy-space-studio-pretty-asia-female-get-197383087.jpg" alt="">
        </div>
    </div>

    <!-- Best seller section -->
    <div class="best-seller-section">
        <h2>Best seller của tháng</h2>
        <div class="row">
            <?php 
                $result = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
                render_product_list($result);
            ?>
        </div>
    </div>


    <!-- Reviews section  -->
    <div class="review-section">
        <div class="review-bg">
            <div class="review-header">
                <h2>Khách hàng nói gì về chúng tôi</h2>
                <p>Reviews của khách hàng</p>
            </div>
            <div class="review-content">
                <div class="row">
                    <?php
                        $comment_list = $conn->query('SELECT comment.content, user.imagePath, user.userName FROM comment join user ON comment.userID = user.id LIMIT 3 ')->fetchAll();
                        foreach($comment_list as $comment){
                            $imagePath = '../backEnd/' .$comment['imagePath'] ;
                    ?>
                            <div class="col col-4 sm-4">
                                <div class="review-card ">
                                    <img src="<?php echo $imagePath?>" alt="">
                                    <div class="stars">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star not-checked"></span>
                                        <span class="fa fa-star not-checked"></span>
                                    </div>
                                    <h2 class="customer-review"><?php echo $comment['content']?></h2>
                                    <p class="customer-name"><?php echo $comment['userName']?></p>
                                </div>
                            </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <!-- Product section -->

    <div class="product-section">
        <h2>Sản phẩm</h2>
        <ul class="product-type-links">
            <li><a class= 'active' href="">Tất cả</a></li>
            <li><a href="">Áo thun</a></li>
            <li><a href="">Quần</a></li>
            <li><a href="">Giày thể thao</a></li>
        </ul>
        <div class="row">
             <?php 
                $result = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
                render_product_list($result);
                ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'assets/include/footer.php'?>
</body>
</html>