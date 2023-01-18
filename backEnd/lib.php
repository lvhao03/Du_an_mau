<?php
  function storeUserInSession($user){
    $_SESSION['user'] = [
      'id' => $user['id'],
      'userName' => $user['userName'],
      'imagePath' => $user['imagePath']
    ]; 
  }

  function checkAction($pageName){
    if (isset($_GET['action'])){
      $action = $_GET['action'];
      switch ($action){
        case 'show':
          include './' .$pageName. '/list.php'; 
          break;
        case 'add':
          include './' .$pageName. '/add.php'; 
          break;
        case 'edit':
          include './' .$pageName. '/edit.php'; 
          break;
        case 'delete':
          include './' .$pageName. '/delete.php'; 
          break;
        case 'show_detail':
          include './' .$pageName. '/detail.php'; 
          break;
      }
    }
  }
  