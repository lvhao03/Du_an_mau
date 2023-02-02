<?php 
    include './db.php';
    $catergory_list = $conn->query('SELECT * FROM catergory')->fetchAll();
?>
<h2>Danh sách danh mục sản phẩm</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach ($catergory_list as $catergory){
            ?>
            <tr>
                <th scope="row"><?php echo $catergory['id']?></th>
                <td><?php echo $catergory['catergoryName']?></td>
                <td>
                    <a href="./admin.php?page=catergory&action=edit&id=<?php echo $catergory['id']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="./admin.php?page=catergory&action=delete&id=<?php echo $catergory['id']?>"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<?php echo '<a href="./admin.php?page=catergory&action=add" class="text-white btn btn-primary">Thêm mới</a>'?>