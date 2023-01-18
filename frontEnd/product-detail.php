<?php 
    session_start();
    include '../backEnd/db.php';
    $a = $conn->prepare('SELECT * from product WHERE id = ?');
    $a->execute([$_GET['id']]);
    $product = $a->fetch(PDO::FETCH_ASSOC);
    $imagePath = 'http://localhost:8080/PHP_1/duAnMau/backEnd/' .$product['imagePath'] ;
    $price = $product['price'] . ' đ';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product detail</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/include/header.css">
    <link rel="stylesheet" href="assets/include/footer.css">
    <link rel="stylesheet" href="assets/DestopCss/destopProductDetail.css">
    <link rel="stylesheet" href="assets/MoblieCss/mobileProductDetail.css">
</head>
<body>
    <?php include 'assets/include/header.php'?>
    <div class="main">
        <?php 
            echo '<a class="bread" href="./index.php">Trang chủ</a>>';
            echo '<a class="bread" href="./product.php?page=1">Sản phẩm</a>>';
            echo '<a class="bread" href="">'.$product['productName'].'</a>';
        ?>
        <div class="product-main">
            <div class="col col-6 sm-4">
                <img class="mainImage" src="<?php echo $imagePath; ?>" alt="">
                <div class="images mobile-hide">
                    <?php 
                        for ($i = 1 ; $i <= 3 ; $i++){
                    ?>
                    <div class="col-2">
                        <img src="<?php echo $imagePath; ?>" alt="">
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col col-6 sm-4 main-right">
                <h2><?php echo $product['productName'];?></h2>
                <div class="stars">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star not-checked"></span>
                    <span class="fa fa-star not-checked"></span>
                </div>
                <div class="price"><?php echo $price;?></div>
                <div class="des">
                    <?php echo $product['des'];?>
                </div>
                <div class="filter-section">
                    <p>Chọn kích cỡ</p>
                    <div class="sizes">
                        <button class="active size-btn">S</button>
                        <button class="size-btn">M</button>
                        <button class="size-btn">X</button>
                        <button class="size-btn">XL</button>
                    </div>
                </div>
                <div class="filter-section">
                    <p>Chọn màu</p>
                    <div class="colors">
                        <p class="active-color red"></p>
                        <p class="purple"></p>
                        <p class="black"></p>
                        <p class="blue"></p>
                    </div>
                </div>
                <div class="filter-section">
                    <p>Số lượng</p>
                    <div class="quantity-bar">
                        <p class="decreaseBtn">-</ơ>
                        <p class="ammount">1</p>
                        <p class="increaseBtn">+</p>
                    </div>
                </div>
                <div class="group-btn">
                    <a href="./cartAction.php?action=add&id=<?php echo $product['id']?>">
                        <button class="btn">Mua ngay</button>
                    </a>
                    <button class="add-to-btn">Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>

        <div class="sub-detail">
            <div class="col">
                <div class="sub-header">
                    <span class="s-btn des active">Mô tả</span>
                    <span class="s-btn reviews">Reviews</span>
                    <span class="s-btn ">Chính sách vận chuyển</span>
                    <span class="s-btn ">Chính sách bảo hành</span>
                </div>
                <div class="sub-content">
                    <div class="left">
                        <h2>Thông số</h2>
                        <div class="left-content">
                            <div class="left-section">
                                <h3>Mã sản phẩm</h3>
                                <p>177013</p>
                            </div>
                            <div class="left-section">
                                <h3>Kích cỡ</h3>
                                <p>Nhỏ</p>
                            </div>
                            <div class="left-section">
                                <h3>Chất liệu</h3>
                                <p>100% Cotton</p>
                            </div>
                            <div class="left-section">
                                <h3>Màu</h3>
                                <p>Đỏ</p>
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <h2>Mô tả sản phẩm</h2>
                        <p>Lorem lorem lorem</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="recommend-section">
        <div class="recommend-content">
            <h2>Có thể bạn sẽ thích</h2>
            <div class="row">
                <?php 
                    include '../backEnd/db.php';
                    $a = $conn->prepare('SELECT * FROM product LIMIT 4');
                    $a->setFetchMode(PDO::FETCH_ASSOC);
                    $a->execute();
                    $result = $a->fetchAll();
                    foreach($result as $product){
                        $imagePath = 'http://localhost:8080/PHP_1/duAnMau/backEnd/' .$product['imagePath'] ;
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
    <?php include 'assets/include/footer.php'?>
    <script>
        let reviews= $('.reviews');
        let des= $('.des');
        let subContentSection = $('.sub-content');
    
        let increaseBtn = $('.increaseBtn');
        let decreaseBtn = $('.decreaseBtn');


        $(document).ready(function(){
            des.click(function(){
                changeBackGroundButton(des);
                subContentSection.css('flex-direction', 'row');
                $.ajax({
                    url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                    data: {
                        action: 'show_product_detail'
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (result){
                        subContentSection.html(result);
                    }
                })
            });


            reviews.click(function(){
                subContentSection.css('flex-direction', 'column');
                changeBackGroundButton(reviews);
                $.ajax({
                    url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php/?id=<?php echo $_GET['id']?>',
                    data: {
                        action: 'show_comment'
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (result){
                        renderCommentSection(result);
                    }
                })

            });

            $(document).on('click', '.send-comment', function(){
                let commentContent = $('.comment-content');
                $.ajax({
                    url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php/?id=<?php echo $_GET['id']?>',
                    data: {
                        action: 'send_comment',
                        content: commentContent.val()
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (result){
                        renderCommentSection(result);
                    }
                })
                    
            })

            function renderCommentSection(result){
                let html = '';
                if (result.length > 0) {
                    $.each(result, (index, user) => {
                        html += `
                                <div class="user-comment">
                                    <img src="../backEnd/${user['imagePath']}">
                                    <div class="user-comment-info">
                                        <div class="user-date">
                                            <h3>${user['userName']}</h3>
                                            <div>${user['date']}</div>
                                        </div>
                                        <p>${user['content']}<p>
                                    </div>
                                </div>
                            `;
                    });
                } else {
                    html += '<p>Hiện chưa có bình luận nào</p>'
                }
                html+= `<textarea class="comment-content" placeholder="Nhập bình luận" name="content" rows="3" cols="10">  </textarea>
                            <button class="add-to-btn send-comment">Gửi bình luận</button>`;
                subContentSection.html(html);
            }

            increaseBtn.click(function(){
                let ammountEle = $('.ammount');
                let ammount = ammountEle.text();
                ammount++;
                ammountEle.text(ammount);
            });

            decreaseBtn.click(function(){
                let ammountEle = $('.ammount');
                let ammount = ammountEle.text();
                ammount--;
                if (ammount < 0) {
                    ammount = 0;
                }
                ammountEle.text(ammount);
            });

            function changeBackGroundButton(ele){
                // Xóa active
                $('.s-btn').each(function(){
                    if ($('.s-btn').hasClass('active')){
                        $('.s-btn').removeClass('active');
                    }
                });
    
                // Thêm active
                ele.addClass('active');
            }
        })
    </script>
</body>
</html>