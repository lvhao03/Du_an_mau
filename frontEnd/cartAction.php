<?php
    session_start();
    // session_destroy();
    $action = $_GET['action'];
    switch($action){
        case 'add':
            addToCart();
            break;
        case 'delete':
            deleteFromCart();
            break;
    }

    function addToCart(){
        include '../backEnd/db.php';
        $sql = 'SELECT product.productName, product.price , product.imagePath, catergory.catergoryName FROM product JOIN catergory WHERE product.id = ? AND product.catergoryid = catergory.id';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_GET['id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$_SESSION['cart']) {
            $_SESSION['cart'] = [];
        }
        array_push($_SESSION['cart'], $result);
        header('Location: ./cart.php');
    }

    function deleteFromCart(){
        unset($_SESSION['cart'][$_GET['index']]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        header('Location: ./cart.php');
    }
