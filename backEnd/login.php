<?php 
    session_start();
    include './db.php';
    include './lib.php';
    if (isset($_GET['userName']) && isset($_GET['passWord'])){
        $user = getUser($_GET['userName'], $_GET['passWord']);
        storeUserInSession($user);        
        redirectUser($user);        
    }

    function redirectUser($user){
        if (isAdmin($user)) {
            return header('Location: ./admin.php?page=index');
        }
        return header('Location: ../frontEnd/index.php');
    }

    function isAdmin($user){
        if ($user['userRole'] == 'admin') {
            return true;
        }
        return false;
    }


    function getUser($user_name, $user_password){
        global $conn;
        $stmt = $conn->prepare('SELECT * FROM user WHERE userName = ? AND passWord = ?');
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute([$user_name,$user_password]);
        $user = $stmt->fetch();
        $conn = null;
        return $user;
    }

    // admin => trângdmin
?>