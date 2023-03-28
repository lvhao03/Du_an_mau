<?php 
    header("Access-Control-Allow-Origin: http://localhost:3000/");
    include './backEnd/db.php';
    $action = $_GET['action'];
    switch ($action) {
        case 'get_product':
            $product_list = $conn->query('SELECT * FROM product LIMIT 4')->fetchAll();
            echo json_encode($product_list);
            break;
    }
?>