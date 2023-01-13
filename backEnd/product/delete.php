<?php
  include './db.php';
  $stmt = $conn->prepare('DELETE FROM product WHERE id= ?');
  $stmt->execute([$_GET['id']]);
  header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=product&action=show');