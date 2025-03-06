<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Mật khẩu</th>
            <th>Chỉnh sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../database/config.php';
        $queryUserManagement = "SELECT * FROM user WHERE role_id = 2";
        $resultUserManagement = mysqli_query($conn, $queryUserManagement);
        while ($rowUserManagement = mysqli_fetch_array($resultUserManagement)) {
            echo
            '<tr>
                <td>' . $rowUserManagement['id'] . '</td>
                <td>' . $rowUserManagement['fullname'] . '</td>
                <td>' . $rowUserManagement['email'] . '</td>
                <td>' . $rowUserManagement['phone_number'] . '</td>
                <td>' . $rowUserManagement['address'] . '</td>
                <td>' . $rowUserManagement['password'] . '</td>
                <td><a href="../admin/index.php?page=editUser&idUser=' . $rowUserManagement['id'] . '"><i class="fa-solid fa-user-pen"></i></a></td>
                <td><a href="../admin/pages-adminHandle/deleteUserHandle.php?idUser=' . $rowUserManagement['id'] . '"><i class="fa-sharp fa-solid fa-trash"></i></a></td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>