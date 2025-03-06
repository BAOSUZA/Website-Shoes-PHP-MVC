<div class="Promotion-products">
    <div class="grid wide">
        <div class="row item itemTab">
            <div class="col c-12 Promotion-products__title showToRight">Sản phẩm đang giảm giá</div>
        </div>
        <div class="row item itemTab">
            <div class="Promotion-products__slide">
                <img class="Promotion-products__slide-slide" src="../images/slide/sale-produtcs.png" alt="">
                <img class="Promotion-products__slide-logo showToTop showToRightTab" src="../images/logo/logo.png" alt="">
                <img class="Promotion-products__slide-name showToTop showToLeftTab" src="../images/logo/name.png" alt="">
                <p class="showToTop showToTopTab delay-06">Sản phẩm đang giảm giá</p>
            </div>
        </div>
        <div class="row item itemTab">
            <?php
            include('../database/config.php');
            $sqlPageDiscount = "SELECT count(id) AS 'slsp' FROM product WHERE discount <> 0";
            $resultPageDiscount = mysqli_query($conn, $sqlPageDiscount);
            $rowPageDiscount = mysqli_fetch_array($resultPageDiscount);
            $pagesDiscount = ceil($rowPageDiscount['slsp'] / 5);
            $current_pageDiscount = 1;
            if (isset($_GET['PageProductDiscount'])) {
                $current_pageDiscount = $_GET['PageProductDiscount'];
            }
            $indexProductDiscount = ($current_pageDiscount - 1) * 5;
            $queryProductSale = "SELECT * FROM `product` WHERE quantity > 0 AND discount <> 0 LIMIT $indexProductDiscount, 5";
            $resultProductSale = mysqli_query($conn, $queryProductSale);
            while ($rowProductSale = mysqli_fetch_array($resultProductSale)) {
                echo
                '
                <div class="col l-2-4 m-4 c-6">
                    <div class="Promotion-products__item">
                        <a href="../pages/detailProduct.php?idProduct='.$rowProductSale['id'].'" class="Promotion-products__item-content">
                            <img class="showToZoom showToZoomTab" src="' . $rowProductSale['thumbnail'] . '" alt="">
                            <div class="Promotion-products__item-sale showToRight showToRightTab">Giảm ' . $rowProductSale['discount'] . '%</div>
                            <div class="Promotion-products__item-body">
                                <p class="showToTop showToTopTab delay-02">' . $rowProductSale['title'] . '</p>
                                <p class="showToTop showToTopTab delay-04">' . number_format(ceil($rowProductSale["price"] - ($rowProductSale["price"] * $rowProductSale["discount"] / 100)), 0, '.', '.') . 'đ <br><del>' . number_format($rowProductSale['price'], 0, '.', '.') . ' đ</del></p>
                                <div class="Promotion-products__item-body-star">
                                    <hr>
                                    <i class="fa-solid fa-star showToTop showToTopTab delay-06"></i>
                                    <i class="fa-solid fa-star showToTop showToTopTab delay-06"></i>
                                    <i class="fa-solid fa-star showToTop showToTopTab delay-06"></i>
                                    <i class="fa-solid fa-star showToTop showToTopTab delay-06"></i>
                                    <i class="fa-solid fa-star showToTop showToTopTab delay-06"></i>
                                    <hr>
                                </div>
                                <div class="Promotion-products__item-body-icon showToTop showToTopTab delay-08">
                                    <a href="../pages-handle/addFavoriteHandle.php?idProduct='.$rowProductSale['id'].'"><i class="fa-regular fa-heart"></i></a>
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                                <div class="Promotion-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct='.$rowProductSale['id'].'" class="Promotion-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
        <div class="row">
            <div class="pagination">
                <ul>
                    <?php
                    echo '<li class="page-item"><a href="?page=Index&PageProductDiscount=' . $current_pageDiscount - 1 . '">&laquo;</a></li>';
                    for ($i = 1; $i <= $pagesDiscount; $i++) {
                        echo '<li class="page-item"><a href="?page=Index&PageProductDiscount=' . $i . '">' . $i . '</a></li>';
                    }
                    echo '<li class="page-item"><a href="?page=Index&PageProductDiscount=' . $current_pageDiscount + 1 . '">&raquo;</a></li>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>