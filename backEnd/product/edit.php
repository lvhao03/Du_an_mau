<?php 
    include_once './db.php';
    $sql = 'SELECT * FROM product where id= ? ';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $file_path = checkFile();
        update_product($conn, $file_path, $product);
        redirect();
    } 

    function redirect(){
        header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=product&action=show');
        die();
    }

    function update_product($conn, $file_path , $product){
        $file_path = $file_path ?? $product['imagePath'];
        $sql = 'UPDATE product SET productName= ?,
        price= ?, des= ? , imagePath = ? WHERE product.id = ? ';
        $stmt = $conn->prepare($sql);  
        $stmt->execute([$_POST['productName'],$_POST['price'], $_POST['des'], $file_path, $_GET['id']]);
    }

    function checkFile(){
        if (!isset($_FILES['myfile']['name'])){
            return null;
        }

        $directory = 'upload/';
        $file_path = $directory . $_FILES['myfile']['name'] ;
    
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $file_path)){
            return $file_path;
        } 
        return null;
    }

?>
<h2>Chỉnh sửa sản phẩm</h2>
<img class="product-img" src="<?php echo $product['imagePath']?>" alt="">
<form class="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="userName">Tên sản phẩm</label>
        <input type="text" name='productName' class="form-control" id="userName" value="<?php echo $product['productName']; ?>" placeholder="Nhập tên người dùng">
    </div>
    <div class="form-group">
        <label for="email">Giá cả</label>
        <input type="text"name='price' class="form-control" id="email" value="<?php echo $product['price']; ?>" placeholder="Nhập email">
    </div>
    <div class="form-group">
        <label for="passWord">Mô tả</label>
        <input type="text" name='des' class="form-control" id="passWord" value="<?php echo $product['des']; ?>" placeholder="Nhập mật khẩu">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Ảnh sản phẩm</label>
        <input type="file" name='myfile' class="form-control" id="formGroupExampleInput2">
    </div>
    <button type='submit' class="btn btn-primary">Chỉnh sửa</button>
    <a href="./admin.php?page=product&action=show" class="text-white btn btn-primary">Xem danh sách</a>
</form>
