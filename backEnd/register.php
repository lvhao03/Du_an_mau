<?php
    include './db.php';
    include './lib.php';
    session_start();
    $stmt = $conn->prepare("INSERT INTO user(userName,email, passWord) VALUES (?,?,?)");
    $stmt->execute([$_POST['userName'],$_POST['email'], $_POST['passWord']]);

    $sql = 'SELECT * FROM user ORDER BY ID DESC ';
    $user = $conn->query($sql)->fetch();
    storeUserInSession($user); 
    header('Location: ../frontEnd/index.php'); 