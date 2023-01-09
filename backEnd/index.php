<?php 
    include './db.php';
    $a = $conn->prepare('SELECT * FROM user WHERE userName= :name');
    $a->bindParam(':name', $_SESSION['user']['userName']);
    $a->setFetchMode(PDO::FETCH_ASSOC);
    $a->execute();
    $user = $a->fetch();
?>
<?php 
    if(isset($_SESSION['user']['userName'])){
        echo '<h2> Xin chào '  . $_SESSION['user']['userName'] .  ' đến với trang admin </h2>';
    }
?>

<button class="btn btn-primary">Chỉnh sửa</button>