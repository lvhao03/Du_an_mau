<header>
    <nav>
        <i class="fas fa-bars destop-hide"></i>
        <img class='Logo' src="./assets/Capture 4.PNG" alt="">
        <ul class="nav-links mobile-hide">
            <li><a href="http://localhost:8080/PHP_1/duAnMau/frontEnd/index.php">Trang chủ</a></li>
            <li><a href="http://localhost:8080/PHP_1/duAnMau/frontEnd/product.php?page=1">Sản phẩm</a></li>
            <li>
                <a href="">Về chúng tôi</a>
                <i class="fas fa-chevron-down"></i>
            </li>
            <li>
                <input class="search-product" type="text" placeholder="Tìm kiếm sản phẩm">
                <div class="content"></div>
            </li>
            <!-- <li>
            </li> -->
        </ul>
        <div class="nav-icon">
            <div class="icon-list">
                <!-- <div class='user-icon'href="">
                    <i class="far fa-user"></i>
                </div> -->
                <?php 
                    if (isset($_SESSION['user'])){
                        echo '<img class="user_avatar" src="../backEnd/'. $_SESSION['user']['imagePath'] .'">';
                        echo '<a class="dio" href="" >xin chào, ' . $_SESSION['user']['userName'] . '</a>';
                        echo '<div class="user-list">
                                <a href="http://localhost:8080/PHP_1/duAnMau/frontEnd/user.php">Thông tin cá nhân</a>
                                <a href="http://localhost:8080/PHP_1/duAnMau/backEnd/signOut.php">Đăng xuất</a>
                              </div>';
                    } else {
                        echo '<div class="user-icon" href="">
                                  <i class="far fa-user"></i>
                              </div>';
                        echo '<div class="user-list">
                                  <a href="http://localhost:8080/PHP_1/duAnMau/frontEnd/login.php">Đăng nhập</a>
                                  <a href="http://localhost:8080/PHP_1/duAnMau/frontEnd/register.php">Đăng ký</a>
                              </div>';
                    }
                ?>
                <a href="./cart.php"><i class="fas far fa-shopping-cart"></i></a></li>
            </div>
            <div class="number-product-in-cart destop">
                <?php 
                    if (isset($_SESSION['cart'])){
                        echo count($_SESSION['cart']);
                    } else {
                        echo 0;
                    }
                ?>
            </div>
        </div>
    </nav>
</header>

<script>
    $(document).ready(function(){
        let content =  $(".content");
        let input = $(".search-product");
        input.keyup(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    keyWord: input.val(),
                    action: 'live_search'
                },
                type: 'POST',
                dataType: 'json',
                success: function (result){
                    let html = "";
                    if (result.length > 0){
                        $.each(result, (index , item) => {
                            let imagePath = 'http://localhost:8080/PHP_1/duAnMau/backEnd/' + item['imagePath'];
                            html += `<li>
                                        <a href="http://localhost:8080/PHP_1/duAnMau/frontEnd/product-detail.php?id=${item['id']}">
                                        <div class='search'>
                                            <img class="img-search" src=${imagePath}>
                                            <span>${item['productName']}</span>
                                        </div>
                                        </a>
                                    </li>`;
                        })
                    } else {
                        html+= '<li class="not-found">ko tìm thấy sản phẩm</li>';
                    }
                    content.html(html);
                }
            })
        });
    })
</script>