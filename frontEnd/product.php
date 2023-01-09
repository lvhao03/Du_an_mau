<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopProduct.css">
    <!-- <link rel="stylesheet" href="assets/MoblieCss/mobileProduct.css"> -->
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <!-- Banner -->
    <div class="banner">
        <img src="https://img.freepik.com/premium-vector/summer-sale-green-white-background-professional-banner-multipurpose-design-free-vector_1340-20165.jpg?w=2000" alt="">
    </div>

    <div class="main">
        <div class="col col-3 sm-4">
            <!-- <div class="filter">
                <h2>Filter</h2>
                <div class="filter-section">
                    <p>Choose Price</p>
                    <hr>
                    <div class="bar">
                        <div class="dot"></div>
                        <p>150$</p>
                    </div>
                </div>
                <div class="filter-section">
                    <p>Choose Size</p>
                    <div class="sizes">
                        <button class="active size-btn">S</button>
                        <button class="size-btn">M</button>
                        <button class="size-btn">X</button>
                        <button class="size-btn">XL</button>
                    </div>
                </div>
                <div class="filter-section">
                    <p>Choose Color</p>
                    <div class="colors">
                        <p class="red"></p>
                        <p class="purple"></p>
                        <p class="black"></p>
                        <p class="blue"></p>
                    </div>
                </div>
                <a href="">
                    <div class="btn">Filter</div>
                </a>
            </div> -->
            <h2>Danh mục</h2>
            <?php 
                include '../backEnd/db.php';
                $catergory = $conn->query('SELECT * FROM catergory');
                echo '<ul class="catergory">';
                foreach($catergory as $n ){
                    echo '<li><a href="http://localhost:8080/PHP_1/assignment1/frontEnd/product.php?catergory='.$n['id'].'">'.$n['catergoryName'].'</a></li>';
                }
                echo '</ul>';
            ?>
        </div>
        <div class="col col-9 sm-4">
            <div class="product">
                <div class="product-header mobile-hide">
                    <div class="product-header-left">
                        <p>Lọc theo</p>
                        <a href="">
                            <button class="active btn-header">Nối bật</button>
                        </a>
                        <a href="">
                            <button class="btn-header">Giá tốt</button>
                        </a>
                        <a href="">
                            <button class="btn-header">Mới nhất</button>
                        </a>
                    </div>
                    <div class="product-header-right">
                        <i class="fas fa-chevron-left"></i>
                        <p>1/25</p>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <div class="product-content">
                    <div class="row">
                        <?php 
                            if (isset($_GET['catergory'])){
                                $sql = 'SELECT * FROM product WHERE catergoryID=' . $_GET['catergory'];
                                $a = $conn->prepare($sql);
                                $a->execute();
                                $result = $a->fetchAll();
                            } else {
                                $offset = ($_GET['page'] - 1) * 6;
                                $sql = 'SELECT * FROM product LIMIT 6 OFFSET '. $offset;
                                $result = $conn->query($sql)->fetchAll();
                            }
                            foreach($result as $product){
                                $imagePath = 'http://localhost:8080/PHP_1/assignment1/backEnd/' .$product['imagePath'] ;
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
                        ?>
                    </div>
                    <div class="pagination">
                        <?php 
                            $num = $conn->query('SELECT * FROM product')->rowCount();
                            for($i = 1; $i <= ceil($num/6) ; $i++){
                                echo '<a href="./product.php?page='.$i.'">'.$i.'</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recomened section -->
    <div class="recommend-section">
        <div class="recommend-content">
            <h2>Các sản phẩm khác</h2>
            <div class="row">
            <?php 
                $result = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
                foreach($result as $product){
                    $imagePath = 'http://localhost:8080/PHP_1/assignment1/backEnd/' .$product['imagePath'] ;
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
            ?>
            </div>
        </div>
    </div>
    <script src='./assets/javascript/numberProduct.js'></script>
    <?php include 'assets/include/footer.php'?>
</body>
</html>