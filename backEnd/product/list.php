<?php 
    include './db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $a = $conn->prepare('SELECT product.id , product.productName, product.price, product.des , catergory.catergoryName, product.imagePath FROM product JOIN catergory WHERE product.catergoryid = catergory.id AND product.productName like :name  LIMIT 5');
        $name = $_POST['name'].'%';
        $a->bindParam(':name', $name);
        $a->setFetchMode(PDO::FETCH_ASSOC);
        $a->execute();
        $result = $a->fetchAll();
    } else {
        $a = $conn->prepare('SELECT product.id , product.productName, product.price, product.des , catergory.catergoryName, product.imagePath FROM product JOIN catergory WHERE product.catergoryid = catergory.id LIMIT 5');
        $a->setFetchMode(PDO::FETCH_ASSOC);
        $a->execute();
        $result = $a->fetchAll();
    }

?>
<h2>Danh sách sản phẩm</h2>
<div class="select">
    <div class="number-of-product">
        <span>Lọc theo danh mục sản phẩm</span>
        <select class="filter-product" name="" id="">
            <option value="0">Tất cả</option>
            <?php 
                $sql = 'SELECT * FROM catergory';
                $catergoryList = $conn->query('SELECT * FROM catergory')->fetchAll();
                foreach($catergoryList as $catergory) {
            ?>
                <option value="<?php echo $catergory['id']?>"><?php echo $catergory['catergoryName']?></option>
            <?php }?>
            <!-- <option value="5">5</option>
            <option value="10">10</option> -->
        </select>
    </div>
    <input class="search" type="text" placeholder="Tìm kiếm theo tên sản phẩm">
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
                ?>
                <tr>
                    <th scope="row"><?php echo $product['id']?></th>
                    <td><img src="<?php echo $product['imagePath'] ?>" class="rounded" alt=""></td>
                    <td><?php echo $product['productName'] ?></td>
                    <td><?php echo $product['catergoryName']?></td>
                    <td><?php echo $product['price']?></td>
                    <td><?php echo $product['des']?></td>
                    <td>
                        <a href="./admin.php?page=product&action=edit&id=<?php echo $product['id']?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                        <a href="./admin.php?page=product&action=delete&id=<?php echo $product['id']?>"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
        <?php }?>
    </tbody>
</table>
<?php echo '<a href="./admin.php?page=product&action=add" class="text-white btn btn-primary">Thêm mới</a>'?>
<script>
      $(document).ready(function(){
        let filterBar = $(".filter-product");
        let tbody = $('tbody');

        // Giới hạn số lượng hiển thị
        filterBar.change(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    catergoryID: filterBar.val(),
                    action: 'filter_product_catergory_backEnd'
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    let html = '';
                    console.log(result);
                    $.each(result, (index , product) => {
                        html += ` <tr>
                                    <th scope="row"> ${product['id']}</th>
                                    <td><img src="${product['imagePath']}" class="rounded" alt=""></td>
                                    <td>${product['productName']}</td>
                                    <td>${product['catergoryName']}</td>
                                    <td>${product['price']}</td>
                                    <td>${product['des']}</td>
                                    <td>
                                        <a href="./admin.php?page=product&action=edit&id=${product['id']}"><i class="fa-solid fa-pen-to-square"></i></a> 
                                        <a href="./admin.php?page=product&action=delete&id=${product['id']}"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>`;
                    })
                    tbody.html(html);
                }
            })
        })

        let searchBar = $('.search');
        searchBar.keyup(function(){
            $.ajax({
                url: 'http://localhost:8080/PHP_1/duAnMau/api/api.php',
                data: {
                    keyWord: searchBar.val(),
                    action: 'search_query',
                    tableName: "product"
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    let html = '';
                    $.each(result, (index , product) => {
                        html += ` <tr>
                                    <th scope="row"> ${product['id']}</th>
                                    <td><img src="${product['imagePath']}" class="rounded" alt=""></td>
                                    <td>${product['productName']}</td>
                                    <td>${product['catergoryName']}</td>
                                    <td>${product['price']}</td>
                                    <td>${product['des']}</td>
                                    <td>
                                        <a href="./admin.php?page=product&action=edit&id=${product['id']}"><i class="fa-solid fa-pen-to-square"></i></a> 
                                        <a href="./admin.php?page=product&action=delete&id=${product['id']}"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>`;
                    })
                    tbody.html(html);
                }
            })
        })
    })
        
</script>