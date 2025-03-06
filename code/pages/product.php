<?php
$category_id = $_GET['category'];
include '../database/config.php';
$resultName = mysqli_query($conn, "SELECT name FROM category WHERE id = $category_id");
$rowName = mysqli_fetch_array($resultName);
$categoryName = $rowName['name'];
?>
<div class="All-products">
    <div class="grid wide">
        <div class="row">
            <p class="All-products__title-sex">Sản phẩm <?= $categoryName ?></p>
        </div>
        <div class="row">
            <?php include("../pages-handle/productHandle.php"); ?>
        </div>
    </div>
</div>