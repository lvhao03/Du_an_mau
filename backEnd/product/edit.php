<?php 
    include './db.php';
    $sql_1 = 'SELECT * FROM product where id=' . $_GET['id'];
    $a = $conn->prepare($sql_1);
    $a->execute();
    $product = $a->fetch();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $filePath = checkFile();
        if (!$filePath) {
            $sql = 'UPDATE product SET productName=?,
                    price=?, des=? WHERE product.id = ? ';
            $a = $conn->prepare($sql);  
            $a->execute(array($_POST['productName'],$_POST['price'], $_POST['des'], $_GET['id']));
            
        } else {
            $sql = 'UPDATE product SET productName=?,
                    price=?, des=? , imagePath = ? WHERE product.id = ? ';
            $a = $conn->prepare($sql);  
            $a->execute(array($_POST['productName'],$_POST['price'], $_POST['des'], $filePath, $_GET['id']));
        }
    } 
    function checkFile(){
        $directory = 'upload/';
        $filePath = $directory . $_FILES['myfile']['name'] ;
        if (file_exists($filePath)){
            return null;
        }
    
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $filePath)){
            return $filePath;
        } else {
            return null;
        }
    }

?>
<h2>Chỉnh sửa sản phẩm</h2>
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
