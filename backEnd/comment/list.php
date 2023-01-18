
<h2>Danh sách bình luận</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Số lượng bình luận</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include './db.php';
            $sql = 'SELECT count(productID) as numberComment FROM comment GROUP BY productID';
            $sql_2 = 'SELECT count(productID) as numberComment , product.id as product_id, product.productName, product.imagePath, comment.id FROM comment join product on comment.productID = product.id group by  productID';
            $number = $conn->query($sql)->fetchAll();
            $commentList = $conn->query($sql_2)->fetchAll();
            foreach($commentList as $comment){
        ?>
        <tr>
            <th scope="row"><?php echo $comment['id']?></th>
            <td><img src="<?php echo $comment['imagePath']?>" alt=""></td>
            <td><?php echo $comment['productName']?></td>
            <td><?php echo $comment['numberComment']?></td>
            <td>
                <a href="./admin.php?page=comment&action=show_detail&id=<?php echo $comment['product_id'] ?>"><i class="fa-solid fa-plus"></i></a>
            </td>
        </tr>
        <?php }?>
    </tbody>