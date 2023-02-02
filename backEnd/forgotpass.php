<?php
    include './db.php';
    $email = $_POST['email'];
    $stmt = $conn->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $user = $stmt->fetch();
    $conn = null;
    return $user;