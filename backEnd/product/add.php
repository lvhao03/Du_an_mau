<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $b = $conn->prepare('SELECT * FROM catergory WHERE catergoryName = ?');
        $b->setFetchMode(PDO::FETCH_ASSOC);
        $b->execute([$_POST['catergoryName']]);
        $catergoryID = $b->fetch();

        $filePath = checkFile();

        $sql = "INSERT INTO product(productName,price, des, catergoryID, imagePath) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array($_POST['productName'], $_POST['price'], $_POST['des'], $catergoryID['id'] ,$filePath));
        // header('Location: http://localhost:8080/PHP_1/duAnMau/backEnd/admin.php?page=user&action=show');
    }
    
    function checkFile(){
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

    function getCatergoryID(){
        global $conn;
        $b = $conn->prepare('SELECT * FROM catergory WHERE catergoryName = :name');
        $b->bindParam(':name', $_POST['catergoryName']);
        $b->setFetchMode(PDO::FETCH_ASSOC);
        $b->execute();
        $user = $b->fetch();
        return $user['id'];
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
                $a = $conn->prepare('SELECT * FROM catergory');
                $a->setFetchMode(PDO::FETCH_ASSOC);
                $a->execute();
                $catergory = $a->fetchAll();
                foreach($catergory as $n){
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
