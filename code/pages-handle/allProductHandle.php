<div class="All-products__shop">
    <div class="grid wide">
        <div class="row item">
            <div class="col l-12 m-12 c-12 All-products__shop-title showToRight">Tất cả sản phẩm</div>
        </div>
        <div class="row">
            <?php
            include '../database/config.php';
            $sqlPageAll = "SELECT count(id) AS 'slsp' FROM product WHERE quantity > 0";
            $resultPageAll = mysqli_query($conn, $sqlPageAll);
            $rowPageAll = mysqli_fetch_array($resultPageAll);
            $pagesAll = ceil($rowPageAll['slsp'] / 10);
            $current_pageAll = 1;
            if (isset($_GET['PageProductAll'])) {
                $current_pageAll = $_GET['PageProductAll'];
            }
            $indexProductAll = ($current_pageAll - 1) * 10;
            $queryProductAll = "SELECT * FROM product WHERE quantity > 0 LIMIT $indexProductAll, 10";
            $resultProductAll = mysqli_query($conn, $queryProductAll);
            while ($rowProductAll = mysqli_fetch_array($resultProductAll)) {
                echo
                '
                    <div class="col l-2-4 m-4 c-6">
                        <div class="All-products__item">
                        <a  class="All-products__item-content" href="../pages/detailProduct.php?idProduct='.$rowProductAll['id'].'">
                            <img src="'.$rowProductAll['thumbnail'].'" alt="Hình ảnh không tồn tại">
                            <div class="All-products__item-body">
                                <p>'.$rowProductAll['title'].'</p>
                                <p>'.number_format($rowProductAll['price'], 0, '.', '.'). ' đ</p>
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
                                    <a href="../pages-handle/addFavoriteHandle.php?idProduct='.$rowProductAll['id'].'"><i class="fa-regular fa-heart"></i></a>
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                                <div class="All-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct='.$rowProductAll['id'].'" class="All-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
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
                    echo '<li class="page-item"><a href="?page=Index&PageProductAll=' . $current_pageAll - 1 . '">&laquo;</a></li>';
                    for ($i = 1; $i <= $pagesAll; $i++) {
                        echo '<li class="page-item"><a href="?page=Index&PageProductAll=' . $i . '">' . $i . '</a></li>';
                    }
                    echo '<li class="page-item"><a href="?page=Index&PageProductAll=' . $current_pageAll + 1 . '">&raquo;</a></li>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>