<?php 
    include '../db.php';
    $sql = 'UPDATE bill SET status = ? WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['status'], $_POST['id']]);