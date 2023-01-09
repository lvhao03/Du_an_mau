<?php
    include './db.php';
    include './lib.php';
    session_start();
    $a = $conn->prepare("INSERT INTO user(userName,email, passWord) VALUES (:name, :email, :pass)");
    $a->bindParam(':name', $_POST['userName']);
    $a->bindParam(':pass', $_POST['passWord']);
    $a->bindParam(':email', $_POST['email']);
    $a->execute();

    $sql = 'SELECT * FROM user ORDER BY ID DESC ';
    $user = $conn->query($sql)->fetch();
    // include './sendMail.php';
    setUserNameInSession($user); 
    header('Location: ../frontEnd/index.php'); 