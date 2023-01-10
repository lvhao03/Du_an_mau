<?php
  include './db.php';
  $a = $conn->prepare('DELETE FROM catergory WHERE catergory.id= :id');
  $a->bindParam(':id', $_GET['id']);
  $a->execute();
  header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=catergory&action=show');