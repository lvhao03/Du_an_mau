<?php
    session_start();
    include '../db.php';
    $id = 'DH_' .getNextID(); 
    $date = date('d.m.Y');
    $address = getAddress();

    $sql = 'INSERT INTO bill(id, name, phone, email, address, note, date , total_money, userID) VALUES (?,?,?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $_POST['userName'],$_POST['phone'], $_POST['email'], $address, $_POST['note'], $date, $_SESSION['totalMoney'], $_SESSION['user']['id']]);
    insert_bill_detail($id);
    deleteCartSessions();
    header('Location: ../../frontEnd/conform.php');
    
    function deleteCartSessions(){
        unset($_SESSION['cart']);
        unset($_SESSION['quantity']);
        unset($_SESSION['totalMoney']);
    }

    function insert_bill_detail($id){
        global $conn;
        // print_r($_SESSION['cart']);
        $sql = 'INSERT INTO bill_detail(bill_id, product_id, num, price) VALUES (?,?,?,?)';
        $stmt = $conn->prepare($sql);
        $i = 0;
        foreach($_SESSION['cart'] as $product){
            $stmt->execute([$id, $product['id'], $_SESSION['quantity'][$i], $product['price']]);
            $i++;
        }
    }
    
    function getNextID(){
        global $conn;
        $sql = 'SELECT count(*) as num from bill';
        $currentID = $conn->query($sql)->fetch();
        // print_r($currentID);
        return $currentID['num'] + 1;
    }

    function getAddress(){
        $arr = [];
        array_push( $arr,getNameOfAddress($_POST['ward']),getNameOfAddress($_POST['district']) ,getNameOfAddress($_POST['province']));
        $addresDetail = implode(', ', $arr);
        return $_POST['street'] . ', ' . $addresDetail;
    }

    function getNameOfAddress($text){
        $arr = explode('|', $text);
        return $arr[1];
    }