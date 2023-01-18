<?php 
    include './db.php';
    $stmt = $conn->prepare('SELECT count(*) as num FROM user WHERE userRole = "Khách hàng" ');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $user = $stmt->fetch();
?>
<h1>DashBoard</h1>
<div class="cards">
    <div class="item">
        <div class="item-info">
            <span class="big-text"><?php echo $user['num'] ?> </span>
            <p class="small-text">Tổng số khách hàng</p>
        </div>
        <i class="fa-solid fa-user-group"></i>
    </div>
    <div class="item">
        <div class="item-info">
            <span class="big-text"><?php echo $user['num'] ?> </span>
            <p class="small-text">Tổng đơn hàng</p>
        </div>
        <i class="fa-solid fa-bag-shopping"></i>
    </div>
    <div class="item">
        <div class="item-info">
            <span class="big-text"><?php echo $user['num'] ?> </span>
            <p class="small-text">Tổng đơn hàng</p>
        </div>
        <i class="fa-solid fa-comments"></i>
    </div>
    <div class="item">
        <div class="item-info">
            <span class="big-text"><?php echo $user['num'] ?> </span>
            <p class="small-text">Tổng đơn hàng</p>
        </div>
        <i class="fa-solid fa-comments"></i>
    </div>
</div>
