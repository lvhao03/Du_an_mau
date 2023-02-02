<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];
    } else {
        $action = $_GET['action'];
    }
    switch($action){
        case 'add':
            add_to_cart();
            break;
        case 'delete':
            delete_from_cart();
            break;
        case 'addQuantity':
            add_quantity_and_total();
            break;
    }

    function add_to_cart(){
        include '../backEnd/db.php';
        $sql = 'SELECT product.id , product.productName, product.price , product.imagePath, catergory.catergoryName FROM product JOIN catergory WHERE product.id = ? AND product.catergoryid = catergory.id';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$_SESSION['cart']) {
            $_SESSION['cart'] = [];
        }
        
        array_push($_SESSION['cart'], $result);
        header('Location: ./cart.php');
    }

    function delete_from_cart(){
        unset($_SESSION['cart'][$_GET['index']]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        header('Location: ./cart.php');
    }

    function add_quantity_and_total(){
        $arr = explode(',' , $_POST['arr']);
        if (!isset($_SESSION['quantity'])){
            $_SESSION['quantity'] = [];
        }

        if (!isset($_SESSION['totalMoney'])){
            $_SESSION['totalMoney'] = $_POST['totalValue'];
        }
        
        $_SESSION['quantity'] = $arr;
        header('Location: ./checkout.php');
    }
