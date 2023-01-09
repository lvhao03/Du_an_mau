<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $a = $conn->prepare('SELECT product.id , product.productName, product.price, product.des , catergory.catergoryName, product.imagePath FROM product JOIN catergory WHERE product.catergoryid = catergory.id AND product.productName like :name ');
        $name = $_POST['name'].'%';
        $a->bindParam(':name', $name);
        $a->setFetchMode(PDO::FETCH_ASSOC);
        $a->execute();
        $result = $a->fetchAll();
    } else {
        $a = $conn->prepare('SELECT product.id , product.productName, product.price, product.des , catergory.catergoryName, product.imagePath FROM product JOIN catergory WHERE product.catergoryid = catergory.id ');
        $a->setFetchMode(PDO::FETCH_ASSOC);
        $a->execute();
        $result = $a->fetchAll();
    }

?>
<h2>Danh sách sản phẩm</h2>
<div class="select">
    <div class="number-of-product">
        <span>Số lượng sản phẩm hiển thị</span>
        <select name="" id="">
            <option value="5">5</option>
        </select>
    </div>
    <input class="search" type="text" placeholder="Tìm kiếm">
</div>
<br>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Giá cả</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        
        <?php 
            foreach ($result as $product){
                echo '<tr>'.
                        '<th scope="row">'. $product['id'] .'</th>'.
                        '<td><img src="' .$product['imagePath'] .'" class="rounded">'.'</td>'.
                        '<td>'. $product['productName'] .'</td>'.
                        '<td>'. $product['catergoryName'] .'</td>'.
                        '<td>'. $product['price'] .' đ</td>'.
                        '<td>'. $product['des'] .'</td>'.
                        '<td>'.
                            '<a href="./admin.php?page=product&action=edit&id=' .$product['id']. '"'. 'class="text-white btn btn-primary">Chỉnh sửa</a>'.
                            '<a href="./admin.php?page=product&action=delete&id=' .$product['id']. '"' .'class="text-white btn btn-danger">Xóa</a>'
                        .'</td>'.
                    '</tr>';
            }
        ?>
    </tbody>
</table>
<?php echo '<a href="./admin.php?page=product&action=add" class="text-white btn btn-primary">Thêm mới</a>'?>
<script>
    
</script>