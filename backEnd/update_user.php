<?php 
    session_start();
    include './db.php';
    $user = get_user($conn);

    if (isset($_POST['userName'])){
        $image_path = check_file();
        delete_file($image_path, $user);
        update_user($conn, $image_path , $user);
        update_user_in_session($image_path);
        header('Location: http://localhost:8080/PHP_1/duAnMau/frontEnd/user.php');
    }

    function delete_file($image_path, $user){
        if (isset($image_path)) {
            return unlink($user['imagePath']);
        }
    }

    function get_user($conn){
        $stmt = $conn->prepare('SELECT * FROM user WHERE id = ?');
        $stmt->execute([$_SESSION['user']['id']]);
        return $stmt->fetch();
    }

    function check_file(){
        if (!isset($_FILES['file']['name'])){
            return null;
        }
        $directory = 'upload/';
        $file_path = $directory . $_FILES['file']['name'];
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)){
            return $file_path;
        }
        return null;
    }

    function update_user_in_session($image_path){
        if ($image_path){
            $_SESSION['user']['imagePath'] = $image_path;
        }
        $_SESSION['user']["userName"] =  $_POST['userName'];
    }

    function update_user($conn, $image_path, $user){
        $image_path = $image_path ?? $user['imagePath'];
        $stmt =  $conn->prepare('UPDATE user SET userName=?, email=?, imagePath=? WHERE id=?');
        $stmt->execute([$_POST['userName'],$_POST['email'], $image_path, $_SESSION['user']['id']]);
    }
?>