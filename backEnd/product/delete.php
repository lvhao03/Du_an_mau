<?php
  include './db.php';
  $a = $conn->prepare('DELETE FROM product WHERE id= :id');
  $a->bindParam(':id', $_GET['id']);
  $a->execute();
  header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=product&action=show');