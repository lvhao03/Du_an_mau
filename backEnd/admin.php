<?php 
    session_start();
    $action = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <nav>
            <h2 class="heading">Trang admin</h2>
            <div class="icons">
                <span><?php echo $_SESSION['user']['userName']?></span>
                <img class="user-img" src="<?php echo $_SESSION['user']['imagePath'] ?>" alt="">
                <a href="./signOut.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </nav>
    </header>

    <div class="main">
        <div class="col-2">
            <ul>
                <a href="./admin.php?page=index">
                    <li>
                        <i class="fas fa-home"></i>
                        <span>Trang chủ</span>
                    </li>
                </a>
                <a href="./admin.php?page=catergory&action=show">
                    <li>
                        <i class="fas fa-list"></i>
                        Danh mục
                    </li>
                </a>
                <a href="./admin.php?page=product&action=show">
                    <li>
                        <i class="fas fa-tshirt"></i>
                        Sản phẩm
                    </li>
                </a>
                <a href="./admin.php?page=user&action=show&type=all">
                    <li>
                        <i class="fas fa-user"></i>
                        Người dùng
                    </li>
                </a>
                <a href="./admin.php?page=order&action=show">
                    <li>
                        <i class="fa-solid fa-cart-shopping"></i>
                        Đơn hàng
                    </li>
                </a>
                <a href="./admin.php?page=comment&action=show">
                    <li>
                         <i class="fa-solid fa-comment"></i>
                        Bình luận
                    </li>
                </a>
                <a href="./admin.php?page=stats&action=show">
                    <li>
                        <i class="fas fa-solid fa-chart-simple"></i>
                        Thống kê
                    </li>
                </a>
            </ul>
        </div>
        <div class="content">
            <?php
                include './lib.php';
                if (isset($_GET['page'])){
                    $page = $_GET['page'];
                    switch($page){
                        case 'catergory':
                            checkAction($page);
                            break;
                        case 'product':
                            checkAction($page);
                            break;
                        case 'user':
                            checkAction($page);
                            break;
                        case 'order':
                            checkAction($page);
                            break;
                        case 'comment':
                            checkAction($page);
                            break;
                        case 'chart':
                            checkAction($page);
                            break;
                        default:
                            include './index.php';
                            break;
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>