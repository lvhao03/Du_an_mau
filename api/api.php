<?php 
    session_start();
    include '../backEnd/db.php';
    $action = $_POST['action'];
    switch($action){
        // Phần frontEnd
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
        case 'filter_product_catergory_frontEnd':
            filter_product_catergory_frontEnd($_POST['data']);
            break;
        case 'filter_product_price':
            filter_product_price($_POST['data']);
            break;

        // Phần backEnd
        case 'list_query_record':
            list_query_record($_POST['type'], $_POST['number']);
            break;
        case 'filter_product_catergory_backEnd':
            filter_product_catergory_backEnd($_POST['catergoryID']);
            break;
        case 'filter_user_role':
            filter_user_role($_POST['userRole']);
            break;
        case 'search_query':
            search_query($_POST['tableName'], $_POST['keyWord']);
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

    function filter_product_price($data){
        global $conn;
        $sql = 'SELECT * FROM product ORDER BY price ' . $data . ' LIMIT 6';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll());
    }

    function filter_product_catergory_frontEnd($data){
        global $conn;
        $sql = 'SELECT * FROM product JOIN catergory where product.catergoryID = catergory.id And catergory.catergoryName ';
        $sql .= "IN (";
        for ($i = 0 ; $i < count($data) ; $i++) {
            $sql .= "'$data[$i]',";
        }
        $sql = substr($sql, 0, -1);
        $sql.= ")";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll());
    }
    
    // Phần backEnd
    function filter_product_catergory_backEnd($catergoryID){
        global $conn;
        if ($catergoryID == 0){
            $sql = 'SELECT * FROM product JOIN catergory where product.catergoryID = catergory.id  LIMIT 5 ';
            echo json_encode($conn->query($sql)->fetchAll());
            return;
        }
        $sql = 'SELECT * FROM product JOIN catergory where product.catergoryID = catergory.id AND catergory.id = ' . $catergoryID. ' LIMIT 5';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll());
    }

    function filter_user_role($userRole){
        global $conn;
        if ($userRole == 0){
            $sql = 'SELECT * FROM user ';
            echo json_encode($conn->query($sql)->fetchAll());
            return;
        }
        $sql = 'SELECT * FROM user WHERE userRole like ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userRole]);
        echo json_encode($stmt->fetchAll());
    }
    function list_query_record($type, $number){
        global $conn;
        $sql = 'SELECT * FROM '. $type . ' LIMIT ' . $number;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo json_encode($stmt->fetchAll());
    }
    
    function search_query($tableName, $keyWord){
        global $conn;
        $param = "%" .$keyWord."%";
        $sql = 'SELECT * FROM ' . $tableName .' WHERE ' . $tableName . 'Name like ? LIMIT 5';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$param]);
        echo json_encode($stmt->fetchAll());
    }

    function filter_product_catergory(){
        
    }