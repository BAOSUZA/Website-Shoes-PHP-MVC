<?php

$category_id = $_GET['category'];
$filterPrice = "";
$displayProduct = 8;
if (!empty($_POST)) {
    $filterPrice = $_POST['filterPrice'];
}
?>
<div class="col l-3 m-3">
    <div class="All-products__control">
        <p>Phân loại theo giá</p>
        <form id="form" method="post">
            <div class=""><input type="submit" value="" name="filterPrice">Tất cả sản phẩm</div>
            <div class=""><input type="submit" value="AND price > 1000000 " name="filterPrice">Lớn hơn 1.000.000đ</div>
            <div class=""><input type="submit" value="AND price BETWEEN 700000 AND 1000000" name="filterPrice">700.000đ - 1.000.000đ</div>
            <div class=""><input type="submit" value="AND price BETWEEN 500000 AND 699999" name="filterPrice">500.000đ - 700.000đ</div>
            <div class=""><input type="submit" value="AND price < 500000 " name="filterPrice">Dưới 500.000đ</div>
        </form>
    </div>
</div>

<div class="col l-9 m-9">
    <div class="All-products__display">
        <span>Hiển thị số sản phẩm theo trang:</span>
        <?php
        for ($i = 1; $i <= 8; $i++) {
            echo '<a class="All-products__num" href="?page=Product&category=' . $category_id . '&displayProduct=' . $i . '">' . $i . '</a>';
        }
        if (isset($_GET['displayProduct'])) {
            $displayProduct = $_GET['displayProduct'];
        }
        ?>

    </div>
    <div class="row">
        <?php
        include("../database/config.php");
        $sqlPage = "SELECT COUNT(id) AS 'Amount' FROM product WHERE category_id = $category_id $filterPrice";
        $resultPage = mysqli_query($conn, $sqlPage);
        $rowPage = mysqli_fetch_array($resultPage);
        $pages = ceil($rowPage['Amount'] / $displayProduct);
        $current_page = 1;
        if (isset($_GET['PageProduct'])) {
            $current_page = $_GET['PageProduct'];
        }
        $indexProduct = ($current_page - 1) * $displayProduct;
        $query = "SELECT * FROM product WHERE category_id = $category_id $filterPrice LIMIT $indexProduct, $displayProduct";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            if ($category_id == 1) {
                echo
                '  
                    <div class="col l-3 m-6 c-6">
                        <div class="All-products__item">
                            <a class="All-products__item-content" href="../pages/detailProduct.php?idProduct=' . $row['id'] . '">
                                <img src="' . $row['thumbnail'] . '" alt="">
                                <div class="All-products__item-body">
                                    <p>' . $row['title'] . '</p>
                                    <p>' . number_format($row['price'], 0, '.', '.')  . ' đ</p>
                                    <div class="All-products__item-body-star">
                                        <hr>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <hr>
                                    </div>
                                    <div class="All-products__item-body-icon">
                                        <i class="fa-regular fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div class="All-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct=' . $row['id'] . '" class="All-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                ';
            } else if ($category_id == 2) {
                echo
                '  
                    <div class="col l-3 m-6 c-6">
                        <div class="All-products__item">
                            <a class="All-products__item-content" href="../pages/detailProduct.php?idProduct=' . $row['id'] . '">
                                <img src="' . $row['thumbnail'] . '" alt="">
                                <div class="All-products__item-body">
                                    <p>' . $row['title'] . '</p>
                                    <p>' . number_format($row['price'], 0, '.', '.')  . ' đ</p>
                                    <div class="All-products__item-body-star">
                                        <hr>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <hr>
                                    </div>
                                    <div class="All-products__item-body-icon">
                                        <i class="fa-regular fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div class="All-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct=' . $row['id'] . '" class="All-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                ';
            } else if ($category_id == 3) {
                echo
                '  
                    <div class="col l-3 m-6 c-6">
                        <div class="All-products__item">
                            <a class="All-products__item-content" href="../pages/detailProduct.php?idProduct=' . $row['id'] . '">
                                <img src="' . $row['thumbnail'] . '" alt="">
                                <div class="All-products__item-body">
                                    <p>' . $row['title'] . '</p>
                                    <p>' . number_format($row['price'], 0, '.', '.')  . ' đ</p>
                                    <div class="All-products__item-body-star">
                                        <hr>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <hr>
                                    </div>
                                    <div class="All-products__item-body-icon">
                                        <i class="fa-regular fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div class="All-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct=' . $row['id'] . '" class="All-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                ';
            } else {
                echo
                '  
                    <div class="col l-3 m-6 c-6">
                        <div class="All-products__item">
                            <a class="All-products__item-content" href="../pages/detailProduct.php?idProduct=' . $row['id'] . '">
                                <img src="' . $row['thumbnail'] . '" alt="">
                                <div class="All-products__item-body">
                                    <p>' . $row['title'] . '</p>
                                    <p>' . number_format($row['price'], 0, '.', '.')  . ' đ</p>
                                    <div class="All-products__item-body-star">
                                        <hr>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <hr>
                                    </div>
                                    <div class="All-products__item-body-icon">
                                        <i class="fa-regular fa-heart"></i>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div class="All-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct=' . $row['id'] . '" class="All-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                ';
            }
        }
        ?>
    </div>
    <div class="row">
        <div class="pagination">
            <ul>
                <?php
                if ($pages > 1) {
                    echo '<li class="page-item"><a href="?page=Product&category=' . $category_id . '&displayProduct='.$displayProduct.'&PageProduct=' . $current_page - 1 . '">&laquo;</a></li>';
                    for ($i = 1; $i <= $pages; $i++) {
                        echo '<li class="page-item"><a href="?page=Product&category=' . $category_id . '&displayProduct='.$displayProduct.'&PageProduct=' . $i . '">' . $i . '</a></li>';
                    }
                    echo '<li class="page-item"><a href="?page=Product&category=' . $category_id . '&displayProduct='.$displayProduct.'&PageProduct=' . $current_page + 1 . '">&raquo;</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>