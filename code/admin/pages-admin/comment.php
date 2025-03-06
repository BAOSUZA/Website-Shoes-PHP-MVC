<table class="table">
    <thead>
        <tr>
            <th>Tên người dùng</th>
            <th>Tên sản phẩm</th>
            <th>Nội dung bình luận</th>
            <th>Ngày/ giờ</th>
            <th>Trả lời bình luận</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../database/config.php';
        $queryUserManagement = "SELECT f.id as idFeedback,fullname,title,f.product_id ,f.content,comment_date , content_reply FROM product p, feedback f, user u WHERE p.id = f.product_id AND u.id = f.user_id ";
        $resultUserManagement = mysqli_query($conn, $queryUserManagement);
        while ($rowUserManagement = mysqli_fetch_array($resultUserManagement)) {
            echo
            '<tr>
                <td>' . $rowUserManagement['fullname'] . '</td>
                <td>' . $rowUserManagement['title'] . '</td>
                <td>' . $rowUserManagement['content'] . '</td>
                <td>' . $rowUserManagement['comment_date'] . '</td>
                <td>' . $rowUserManagement['content_reply'] . '</td>
                <td><a href="../admin/index.php?page=Reply&id='.$rowUserManagement['idFeedback'].'">Phản hồi</a></td>  
            </tr>
                

              
            ';
        
        }
        ?>
    </tbody>
</table>