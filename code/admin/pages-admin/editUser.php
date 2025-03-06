<?php
$idUser = $_GET['idUser'];
include("../database/config.php");
$sql = "SELECT * FROM user WHERE id = $idUser";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($kq);
?>

<div class="form-login">
    <h3>CHỈNH SỬA NGƯỜI DÙNG</h3>
    <form class="form-login__container" action="../admin/pages-adminHandle/editUserHandle.php" method="POST">
        <input type="text" name="iduser" value="<?= $idUser ?>" style="display: none;">
        <input type="text" class="test123" name="fullname" placeholder="Tên khách hàng" value="<?= $row['fullname'] ?>">
        <input type="text" name="email" placeholder="Email" value="<?= $row['email'] ?>" required>
        <input type="text" name="phone_number" placeholder="Số điện thoại" value="<?= $row['phone_number'] ?>" required>
        <input type="text" name="address" placeholder="Địa chỉ" value="<?= $row['address'] ?>" required>
        <input type="text" name="password" placeholder="Mật khẩu" value="<?= $row['password'] ?>" required>
        <select name="role_id" style=" 
        width: 100%;
        height: 35px;
        border-radius: 3px;
        margin-bottom: 20px;
        padding: 0px 7px;
        font-size: 14px">
            <?php
            $kq = mysqli_query($conn, "SELECT * FROM user where id = $idUser");
            while ($rowCheck = mysqli_fetch_array($kq)) { ?>
                <option value="">-- Chọn quyền người dùng -- </option>
                <option <?php echo ($rowCheck['role_id'] == '2') ? "selected" : "" ?> value="2">Người dùng</option>
                <option <?php echo ($rowCheck['role_id'] == '1') ? "selected" : "" ?> value="1">Admin</option>
            <?php } ?>
        </select>
        <input type="submit" value="Cập nhật">
    </form>
</div>