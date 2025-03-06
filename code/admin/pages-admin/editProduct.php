<?php
    $Category_ID = $_GET['Category_ID'];
    $Product_ID = $_GET['Product_ID'];
    include ("../database/config.php");
    $sql = "SELECT * FROM product WHERE id = $Product_ID";
    $kq = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($kq);
?>

<div class="form-login">
    <h3>SỬA SẢN PHẨM</h3>
    <form class="form-login__container" action="../admin/pages-adminHandle/editProductHandle.php" enctype="multipart/form-data" method="POST" >
        <input type="text" name="Product_ID" value="<?=$Product_ID?>" style="display: none;">
        <input type="text" name="category_Id" value="<?=$Category_ID?>" style="display: none;">
        <input type="file" name="thumbnail" placeholder="Ảnh sản phẩm" value= "<?= $row['thumbnail']?>" >
        <input type="text" name="title" placeholder="Tên sản phẩm" value= "<?= $row['title']?>" required>
        <input type="text" name="price" placeholder="Giá" value= "<?= $row['price']?>" required>
        <input type="text" name="discount" placeholder="Giảm giá sản phẩm (Nếu có)" value= "<?= $row['discount']?>">
        <input type="text" name="quantity" placeholder="Số lượng trong kho" value= "<?= $row['quantity']?>" required>
        <input type="submit" value="Cập nhật">
    </form>
</div>