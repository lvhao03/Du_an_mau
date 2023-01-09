<?php
    include './db.php';
    $email = $_POST['email'];
    $a = $conn->prepare('SELECT * FROM user WHERE email = :email');
    $a->bindParam(':email', $email);
    $a->setFetchMode(PDO::FETCH_ASSOC);
    $a->execute();
    $user = $a->fetch();
    $conn = null;
    return $user;