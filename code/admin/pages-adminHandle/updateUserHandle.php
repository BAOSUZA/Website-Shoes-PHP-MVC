<div class="form-register">
    <form class="form-login__container" action="" method="POST">
        <input type="text" id="fullname" name="fullname" placeholder="Họ và tên" required>
        <input type="text" id="email" name="email" placeholder="Email" required>
        <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
        <input type="text" id="phonenumber" name="phonenumber" placeholder="Số điện thoại" required>
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
        <select name="">
            <?php
                $kq = mysqli_query($conn, "SELECT * FROM nguoidung nd, vaitro vt WHERE nd.ID_VaiTro = vt.IDVaiTro");
                while ($rowCheck = mysqli_fetch_array($kq)) {
                    if ($rowCheck['ID_VaiTro'] == $Role_old) {
                        echo '<option value="'.$rowCheck['ID_VaiTro'].'" selected>'.$rowCheck['VaiTro'].'</option>';
                    }else {
                        echo '<option value="'.$rowCheck['ID_VaiTro'].'">'.$rowCheck['VaiTro'].'</option>';
                    }
                }
            ?>
            </select>
        <input style="background-color: #009CFF;" type="submit" value="Cập nhật">
    </form>
</div>