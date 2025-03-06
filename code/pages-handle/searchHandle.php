<div class="All-products__shop">
    <div class="grid wide">
        <div class="row">
            <?php
            include '../database/config.php';
            $content = "";
            if (!empty($_POST)) {
                $content = $_POST['content'];
            }
            if (!empty($_GET['content'])) {
                $content = $_GET['content'];
            }
            $sqlPageAll = "SELECT count(id) AS 'slsp' FROM product WHERE title LIKE '%$content%'";
            $resultPageAll = mysqli_query($conn, $sqlPageAll);
            $rowPageAll = mysqli_fetch_array($resultPageAll);
            $pagesAll = ceil($rowPageAll['slsp'] / 10);
            $current_pageAll = 1;
            if (isset($_GET['PageProductAll'])) {
                $current_pageAll = $_GET['PageProductAll'];
            }
            $indexProductAll = ($current_pageAll - 1) * 10;
            $queryProductAll = "SELECT * FROM product WHERE quantity > 0 AND title LIKE '%$content%' LIMIT $indexProductAll, 10";
            $resultProductAll = mysqli_query($conn, $queryProductAll);
            while ($rowProductAll = mysqli_fetch_array($resultProductAll)) {
                echo
                '
                    <div class="col l-2-4 m-4 c-6">
                        <div class="All-products__item">
                        <a  class="All-products__item-content" href="../pages/detailProduct.php?idProduct='.$rowProductAll['id'].'">
                            <img src="'.$rowProductAll['thumbnail'].'" alt="">
                            <div class="All-products__item-body">
                                <p>'.$rowProductAll['title'].'</p>
                                <p>'.number_format($rowProductAll['price'], 0, '.', '.') .'đ</p>
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
                    <li class="page-item"><a href="#">&laquo;</a></li>
                    <?php
                    for ($i = 1; $i <= $pagesAll; $i++) {
                        echo '<li class="page-item"><a href="?page=Search&PageProductAll=' . $i . '&content='.$content.'">' . $i . '</a></li>';
                    }
                    ?>
                    <li class="page-item"><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>