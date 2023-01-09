<?php 
    include './db.php';
    $a = $conn->prepare('DELETE FROM user WHERE user.id= :id');
    $a->bindParam(':id', $_GET['id']);
    $a->execute();
    header('Location: http://localhost:8080/PHP_1/assignment1/backEnd/admin.php?page=user&action=show');