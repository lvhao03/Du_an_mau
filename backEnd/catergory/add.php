<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $stmt = $conn->prepare("INSERT INTO catergory(catergoryName) VALUES (?)");
        $stmt->execute([$_POST['catergoryName']]);
        header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=catergory&action=show');
    }
?>

<h2>Thêm mới danh mục</h2>
<form class="form" method="POST">
    <div class="form-group">
        <label for="catergoryName">Tên danh mục</label>
        <input type="text" name="catergoryName" required class="form-control" id="catergoryName" placeholder="Nhập tên danh mục">
    </div>
    <button type='submit' class="btn btn-primary">Thêm</button>
</form>
