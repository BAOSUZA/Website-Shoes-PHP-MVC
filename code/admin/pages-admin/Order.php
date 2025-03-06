<table class="table">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên Khách hàng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Ngày đặt hàng</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Cập nhật đang vận chuyện</th>
            <th>Cập nhật đã giao hàng</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include '../database/config.php';
        $queryUserManagement = "SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS  Stt FROM orders";
        $resultUserManagement = mysqli_query($conn, $queryUserManagement);
        while ($rowUserManagement = mysqli_fetch_array($resultUserManagement)) {
            echo
            '<tr>
                <td>' . $rowUserManagement['Stt'] . '</td>
                <td>' . $rowUserManagement['fullname'] . '</td>
                <td>' . $rowUserManagement['email'] . '</td>
                <td>' . $rowUserManagement['phone_number'] . '</td>
                <td>' . $rowUserManagement['address'] . '</td>
                <td>' . $rowUserManagement['order_date'] . '</td>
                <td>' . $rowUserManagement['status'] . '</td>
                <td>' . number_format($rowUserManagement['total_money'], 0, '.', '.')  . 'đ</td>
                <td><a href="../admin/pages-adminHandle/updateStatusHandle.php?idOrder='.$rowUserManagement["id"].'&Status=1">Cập nhật</a></td>
                <td><a href="../admin/pages-adminHandle/updateStatusHandle.php?idOrder='.$rowUserManagement["id"].'&Status=2">Cập nhật</a></td>
            </tr>
            ';
            }
        ?>
    </tbody>
</table>