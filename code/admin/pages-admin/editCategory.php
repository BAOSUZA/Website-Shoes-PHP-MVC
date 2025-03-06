<?php
$id = $_GET['id'];
include("../database/config.php");
$sql = "SELECT * FROM category WHERE id = $id";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($kq);
?>
<div class="form-login">
    <h3>SỬA DANH MỤC</h3>
    <form class="form-login__container" action="../admin/pages-adminHandle/editCategoryHandle.php?page=editCategoryHandle&id=<?=$row['id']?> " method="POST">
        <input type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="Tên danh mục" required>
        <input type="submit" value="cập nhật">
    </form>
</div>