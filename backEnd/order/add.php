<?php
    session_start();
    include '../db.php';
    $id = 'DH_' .get_next_id(); 
    $date = date('d.m.Y');
    $address = get_address();

    $sql = 'INSERT INTO bill(id, name, phone, email, address, note, date , total_money, userID) VALUES (?,?,?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $_POST['userName'],$_POST['phone'], $_POST['email'], $address, $_POST['note'], $date, $_SESSION['totalMoney'], $_SESSION['user']['id']]);
    insert_bill_detail($id);
    delete_cart_sessions();
    header('Location: ../../frontEnd/conform.php');
    
    function delete_cart_sessions(){
        unset($_SESSION['cart']);
        unset($_SESSION['quantity']);
        unset($_SESSION['totalMoney']);
    }

    function insert_bill_detail($id){
        global $conn;
        $sql = 'INSERT INTO bill_detail(bill_id, product_id, num, price) VALUES (?,?,?,?)';
        $stmt = $conn->prepare($sql);
        $i = 0;
        foreach($_SESSION['cart'] as $product){
            $stmt->execute([$id, $product['id'], $_SESSION['quantity'][$i], $product['price']]);
            $i++;
        }
    }
    
    function get_next_id(){
        global $conn;
        $sql = 'SELECT count(*) as num from bill';
        $currentID = $conn->query($sql)->fetch();
        return $currentID['num'] + 1;
    }

    function get_address(){
        $arr = [];
        array_push($arr, 
            get_name_of_address($_POST['ward']), 
            get_name_of_address($_POST['district']), 
            get_name_of_address($_POST['province'])
        );
        $addresDetail = implode(', ', $arr);
        return $_POST['street'] . ', ' . $addresDetail;
    }

    function get_name_of_address($text){
        $arr = explode('|', $text);
        return $arr[1];
    }