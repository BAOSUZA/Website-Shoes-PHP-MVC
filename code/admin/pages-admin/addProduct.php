
<div class="form-login">
    <h3>THÊM SẢN PHẨM</h3>
    <form class="form-login__container" action="../admin/pages-adminHandle/createProductHandle.php" enctype="multipart/form-data" method="POST" >
        <select name="category_Id" style=" 
                width: 100%;
                height: 35px;
                border-radius: 3px;
                margin-bottom: 20px;
                padding: 0px 7px;
                ">
            <?php
            include("../database/config.php");
            $kq = mysqli_query($conn, "SELECT * FROM category");
            while ($rowCheck = mysqli_fetch_array($kq)) {
                echo ' <option value="' . $rowCheck['id'] . '">'.$rowCheck['id'].' - ' . $rowCheck['name'] . '</option>';
            }
            ?>


        </select>
        <input type="file" class="test123" name="thumbnail" placeholder="Ảnh sản phẩm" required>
        <input type="text" name="title" placeholder="Tên sản phẩm" required>
        <input type="text" name="price" placeholder="Giá" required>
        <input type="text" name="discount" placeholder="Giảm giá sản phẩm (Nếu có)">
        

        <input type="text" name="description" placeholder="Mô tả sản phẩm" required>
        <input type="text" name="quantity" placeholder="Số lượng trong kho" required>
        <input type="submit" value="THÊM">
    </form>
</div>