<div class="form-register">
    <h3>Đăng ký</h3>
    <form class="form-register__container" action="../pages-handle/registerHandle.php" method="POST">
        <input type="text" id="fullname" name="fullname" placeholder="Họ" required>
        <input type="text" id="email" name="email" placeholder="Email" required>
        <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
        <input type="text" id="phonenumber" name="phonenumber" placeholder="Số điện thoại" required>
        <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
        <input type="password" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu" required>

        <div class="checkbox">
            <input type="checkbox" id="passwordLogin" name="checkbox" required>Tôi xác nhận đồng ý tất
            cả điều khoản và Nội dung pháp lý của chúng tôi</input>
        </div>
        <input type="submit" value="Đăng ký">
        <a href="../user/index.php?page=Login">Đã có tài khoản, đăng nhập ngay!</a>
    </form>
</div>