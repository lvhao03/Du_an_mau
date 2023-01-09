<?php 
    include './db.php';
    $catergory = $conn->query('SELECT * FROM catergory')->fetchAll();
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
            foreach ($catergory as $n){
                echo '<tr>'.
                        '<th scope="row">'. $n['id'] .'</th>'.
                        '<td>'. $n['catergoryName'] .'</td>'.
                        '<td>'.
                            '<a href="./admin.php?page=catergory&action=edit&id=' .$n['id']. '"'. 'class="text-white btn btn-primary">Chỉnh sửa</a>'.
                            '<a href="./admin.php?page=catergory&action=delete&id=' .$n['id']. '"' .'class="text-white btn btn-danger">Xóa</a>'
                        .'</td>'.
                    '</tr>';
            }
        ?>
    </tbody>
</table>
<?php echo '<a href="./admin.php?page=catergory&action=add" class="text-white btn btn-primary">Thêm mới</a>'?>