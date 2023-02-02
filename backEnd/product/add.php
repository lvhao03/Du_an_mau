<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catergory_id = get_catergory_id($conn);
        $image_path = check_file();
        insert_product($conn, $image_path, $catergory_id);
        header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=user&action=show');
    }
    
    function insert_product($conn, $image_path, $catergory_id){
        $sql = "INSERT INTO product(productName,price, des, catergoryID, imagePath) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['productName'], $_POST['price'], $_POST['des'], $catergory_id, $image_path]);
    }

    function check_file(){
        $directory = 'upload/';
        $filePath = $directory . $_FILES['file']['name'];
        if (file_exists($filePath)){
            echo 'File da ton tai';
        }
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)){
            return $filePath;
        } else {
            echo 'upload thất bại';
        }
    }

    function get_catergory_id($conn){
        $stmt = $conn->prepare('SELECT * FROM catergory WHERE catergoryName = ?');
        $stmt->execute([ $_POST['catergoryName']]);
        $catergory = $stmt->fetch();
        return $catergory['id'];
    }

?>


<h2>Thêm mới sản phẩm</h2>
<form class="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="formGroupExampleInput">Tên sản phẩm</label>
        <input type="text" name="productName" required class="form-control" id="formGroupExampleInput" placeholder="Nhập tên sản phẩm">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Danh mục sản phẩm</label>
        <select name='catergoryName' class="form-control" name="" id="">
            <?php
                include './db.php';
                $stmt = $conn->prepare('SELECT * FROM catergory');
                $stmt->execute();
                $catergory_list = $stmt->fetchAll();
                foreach($catergory_list as $n){
                    echo '<option value="'.$n['catergoryName'].'">' . $n['catergoryName'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Mô tả</label>
        <textarea type="text" name='des'required class="form-control" id="formGroupExampleInput2" placeholder="Nhập mô tả"></textarea>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Giá sản phẩm</label>
        <input type="number" name='price' required class="form-control" id="formGroupExampleInput2" placeholder="Nhập giá">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Thêm ảnh sản phẩm</label>
        <input type="file" name='file' required class="form-control" id="formGroupExampleInput2" placeholder="Another input">
    </div>
    <button type='submit' class="btn btn-primary">Thêm</button>
</form>
