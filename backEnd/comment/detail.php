<h2>Danh sách bình luận chi tiết của sản phẩm</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên người bình luận</th>
            <th scope="col">Nội dung bình luận</th>
            <th scope="col">Ngày bình luận</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include './db.php';
            $sql = 'SELECT comment.id , user.userName, comment.content, comment.date FROM comment join product on comment.productID = product.id join user on user.id = comment.userID WHERE product.id = ?';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_GET['id']]);
            $comment_list = $stmt->fetchAll();
            foreach($comment_list as $comment){
        ?>
                <tr>
                    <th scope="row"><?php echo $comment['id']?></th>
                    <td><?php echo $comment['userName']?></td>
                    <td><?php echo $comment['content']?></td>
                    <td><?php echo $comment['date']?></td>
                    <td>
                        <a href="./admin.php?page=comment&action=delete&id=<?php echo $comment['id']?>"><i class="fa-solid fa-trash"></i></a>
                    </td>

                </tr>
        <?php }?>
    </tbody>