<?php
  include './db.php';
  $stmt = $conn->prepare('DELETE FROM product WHERE id= ?');
  $stmt->execute([$_GET['id']]);

  $product = get_product_image_path($conn);
  delete_file($product['imagePath']);
  header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=product&action=show');
  
  function get_product_image_path($conn){
    $stmt = $conn->prepare('SELECT * from product WHERE id= ?');
    $stmt->execute([$_GET['id']]);
    return $stmt->fetch();
  }
  function delete_file($image_path){
    return unlink($image_path);
  }