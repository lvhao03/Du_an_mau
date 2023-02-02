<?php
  include './db.php';
  $comment = get_comment($conn);
  delete_comment($conn,$comment);
  header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=comment&action=show');
 
  function get_comment($conn){
    $stmt = $conn->prepare('SELECT * FROM comment WHERE id= ?');
    $stmt->execute([$_GET['id']]);
    return $stmt->fetch();
  }

  function is_root_comment($comment){
    if ($comment['parent_id'] == 0){
      return true;
    }
    return false;
  }

  function delete_comment($conn, $comment){
    if (is_root_comment($comment)){
      delete_sub_comment($conn, $comment);
    }
    $stmt = $conn->prepare('DELETE FROM comment WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    return;
  }

  function delete_sub_comment($conn, $comment){
    $stmt = $conn->prepare('DELETE FROM comment WHERE parent_id = ?');
    $stmt->execute([$_GET['id']]);
  }