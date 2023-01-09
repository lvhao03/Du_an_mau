<?php 
    session_start();
    include '../backEnd/db.php';
    $id = $_SESSION['id'];
    $imagePath = checkFile();
    $sql = 'UPDATE user SET userName=?, email=?, imagePath=? WHERE id=?';
    $a = $conn->prepare($sql);
    $a = $a->execute(array($_POST['userName'],$_POST['email'],$imagePath, $id));
    $_SESSION['imagePath'] = $imagePath;
    $_SESSION["userName"] =  $_POST['userName'];
    header('Location: http://localhost:8080/PHP_1/assignment1/frontEnd/user.php');
    
    function checkFile(){
        $directory = 'upload/';
        $filePath = $directory . $_FILES['file']['name'];
        echo $filePath;
        if (file_exists($filePath)){
            echo 'File da ton tai';
        }
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)){
            return $filePath;
        } else {
            echo 'upload thất bại';
        }
    }

?>