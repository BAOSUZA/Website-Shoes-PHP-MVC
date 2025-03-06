<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kiểu giày</th>
            <th>Tên giày</th>
            <th>Giá (VND)</th>
            <th>Giảm giá (%)</th>
            <th>Số lượng trong kho</th>
            <th>Số lượng đã bán</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../database/config.php';
        $queryUserManagement = "SELECT *, product.id as idProduct FROM product,category WHERE category.id = product.category_id ORDER BY `idProduct` ASC";
        $resultUserManagement = mysqli_query($conn, $queryUserManagement);
        while ($rowUserManagement = mysqli_fetch_array($resultUserManagement)) {
            echo
            '<tr>
                <td>' . $rowUserManagement['idProduct'] . '</td>
                <td>' . $rowUserManagement['name'] . '</td>
                <td>' . $rowUserManagement['title'] . '</td>
                <td>' . number_format($rowUserManagement['price'], 0, '.', '.')  . 'đ</td>
            ';
            if($rowUserManagement['discount'] != NULL) {
                echo '<td>' . $rowUserManagement['discount'] . ' % </td>';
            }
            else {
                echo '<td>0 % </td>';
            }
            echo ' <td>' . $rowUserManagement['quantity'] . ' sản phẩm</td>
            <td>' . $rowUserManagement['quantity_purchased'] . ' sản phẩm</td>
            <td><a href="../admin/index.php?page=editProduct&Category_ID=' . $rowUserManagement['id'] . '&Product_ID='.$rowUserManagement['idProduct'].'"><i class="fa-solid fa-user-pen"></i></a></td>
            <td><a href="../admin/pages-adminHandle/deleteProductHandle.php?id=' . $rowUserManagement['idProduct'] . '"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
        </tr>';    
        }
        ?>
    </tbody>
</table>