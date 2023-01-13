<?php 
    include './db.php';
    $stmt = $conn->prepare('SELECT * FROM user WHERE userName= ?');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([$_SESSION['user']['userName']]);
    $user = $stmt->fetch();
?>
    <h1>DashBoard</h1>
<?php 
    if(isset($_SESSION['user']['userName'])){
        echo '<h2> Xin chào '  . $_SESSION['user']['userName'] .  ' đến với trang admin </h2>';
    }
?>

<button class="btn btn-primary">Chỉnh sửa</button>