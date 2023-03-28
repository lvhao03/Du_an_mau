<?php
    include './db.php';
    include './lib.php';
    session_start();

    if (is_avaible_user_name($conn)){
        insert_user($conn);
        save_user_in_session($conn);
    }
    header('Location: ../frontEnd/register.php?error=1'); 

    function is_avaible_user_name($conn){
        $stmt = $conn->prepare('SELECT * FROM user WHERE userName = ?');
        $stmt->execute([$_POST['userName']]);
        if ($stmt->rowCount() == 0){
            return true;
        }
        return false;
    }

    function insert_user($conn){
        $hash = password_hash($_POST['passWord'], PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO user(userName,email, passWord) VALUES (?,?,?)");
        $stmt->execute([$_POST['userName'],$_POST['email'], $hash]);
    }

    function save_user_in_session($conn){
        $sql = 'SELECT * FROM user ORDER BY ID DESC ';
        $user = $conn->query($sql)->fetch();
        storeUserInSession($user); 
        header('Location: ../frontEnd/index.php'); 
        die();
    }