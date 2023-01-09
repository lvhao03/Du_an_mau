<?php 
    session_start();
    include '../backEnd/db.php';
    $action = $_POST['action'];
    switch($action){
        case 'live_search':
            live_search($_POST['keyWord']);
            break;
        case 'show_comment':
            show_comment($_GET['id']);
            break;
        case 'show_product_detail':
            show_product_detail();
            break;
        case 'send_comment':
            send_comment();
            break;
    }

    function live_search($keyWord){
        global $conn;
        $param = "%" .$keyWord."%";
        $sql = 'SELECT * FROM product WHERE productName like ? LIMIT 3';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$param]);
        echo json_encode($stmt->fetchAll());
    }

    function send_comment(){
        global $conn;
        $date = date('d.m.Y');
        $sql = 'INSERT INTO comment(content,userID, productID, date)  VALUES (?,?,?,?)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['content'], $_SESSION['user']['id'], $_GET['id'], $date]);
        show_comment($_GET['id']);
    }

    function show_product_detail(){
        $html = '
        <div class="left">
            <h2>Information</h2>
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
        </div>';
        echo json_encode($html);
    }

    function show_comment($id){
        global $conn;
        $sql = 'SELECT * FROM comment JOIN user ON comment.userID = user.id AND productID = ? ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        echo json_encode($stmt->fetchAll());
    }