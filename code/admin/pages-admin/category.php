<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Tên danh mục</th>
            <th>Chỉnh sửa</th>

        </tr>
    </thead>
    <tbody>
        <?php
        include '../database/config.php';
        $queryUserManagement = "SELECT * FROM category";
        $resultUserManagement = mysqli_query($conn, $queryUserManagement);
        while ($rowUserManagement = mysqli_fetch_array($resultUserManagement)) {
            echo
            '<tr>
                <td>' . $rowUserManagement['id'] . '</td>
                <td>' . $rowUserManagement['name'] . '</td>
                <td><a href="../admin/index.php?page=editCategory&id='.$rowUserManagement['id'].'"><i class="fa-solid fa-user-pen"></i></a></td>  
            </tr>
            ';
        }
        ?>
    </tbody>
</table>