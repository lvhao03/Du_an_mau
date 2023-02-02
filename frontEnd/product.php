<?php 
    session_start();

    function render_product_list($product_list){
        foreach($product_list as $product){
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
    }
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
            <h2>Bộ lọc tìm kiếm</h2>
            <p>Theo danh mục</p>
            <?php 
                include '../backEnd/db.php';
                $catergory_list = $conn->query('SELECT * FROM catergory');
                echo '<ul class="catergory">';
                foreach($catergory_list as $catergory ){
            ?>
                    <div class="checkbox-control">
                        <input value="<?php echo $catergory['catergoryName']?>" name="catergory[]" type="checkbox" id="<?php echo $catergory['catergoryName']?>">
                        <label for="<?php echo $catergory['catergoryName']?>"><?php echo $catergory['catergoryName']?></label>
                    </div>
            <?php }?>
            </ul>
            <hr>
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
                        <select class="select-price btn-header" name="" id="">
                            <option selected="selected" value="asc">Giá thấp đến cao</option>
                            <option value="desc">Giá cao đến thấp</option>
                        </select>
                    </div>
                </div>
                <div class="product-content">
                    <div class="row main-row">
                        <?php 
                            $offset = ($_GET['page'] - 1) * 6;
                            $sql = 'SELECT * FROM product ORDER BY price asc LIMIT 6 OFFSET '. $offset;
                            $product_list = $conn->query($sql)->fetchAll();
                            render_product_list($product_list);
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
                $product_recommend_list = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
                render_product_list($product_recommend_list);
            ?>
            </div>
        </div>
    </div>
    <script src='./assets/javascript/numberProduct.js'></script>
    <?php include 'assets/include/footer.php'?>
    <script>
        $(document).ready(function(){
            let selectPrice = $('.select-price');
            let row = $('.main-row');
            let pagination = $('.pagination');
            let checkBoxCatergory = $('input[name="catergory[]"]');

            selectPrice.change(function(){
                $.ajax({
                    url: '../api/api.php',
                    data: {
                        data: selectPrice.val(),
                        action: 'filter_product_price'
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(result){
                        row.html(renderProductSection(result));
                    }
                })
            })

            checkBoxCatergory.click(function(){
                let array = [];
                $.each($('input[name="catergory[]"]:checked'), function(){
                  array.push($(this).val());
                });

                $.ajax({
                    url: '../api/api.php',
                    data: {
                        data: array,
                        action: 'filter_product_catergory_frontEnd'
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(result){
                        row.html(renderProductSection(result));
                    }
                })
            })
        });      

        function renderProductSection(productList){
            let html = '';
            productList.forEach(product => {
                html += `<div class="col col-3 sm-2">
                            <div class="card">
                                <img src="http://localhost:8080/PHP_1/duAnMau/backEnd/${product['imagePath']}" alt="">
                                <h2 class="product-title">${product['productName']}</h2>
                                <div class="product-words">
                                    <p class="product-des">${product['des']}</p>
                                    <p class="product-price">${product['price']}</p>
                                </div>
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star not-checked"></span>
                                    <span class="fa fa-star not-checked"></span>
                                </div>
                                <a href="./product-detail.php?id=${product['id']}" class="btn-link">
                                    <button class="btn">Mua ngay</button>
                                </a>
                            </div>
                        </div>`;
            });
            return html;
        }

        function createPagination(quantityOfProduct){
            let html = '';
            for(let i = 1 ; i <= ceil(quantityOfProduct/6) ; i++){
                html += `<a href="./product.php?page=${i}">${i}</a>`;
            }
            return html;
        }
    </script>
</body>
</html>