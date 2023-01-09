<?php 
    $host = 'localhost:3307';
    $dbName = 'fashion';
    $userName = 'root';
    $password = '';
    try {
        // Kết nối
        $conn = new PDO("mysql:host=$host;dbname=$dbName", $userName, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
    }
?>