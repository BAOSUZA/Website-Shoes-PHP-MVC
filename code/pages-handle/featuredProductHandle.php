<div class="Featured-products">
    <div class="grid wide">
        <div class="row item itemTab">
            <div class="col l-12 Featured-products__title showToRight showToRightTab">SẢN PHẨM NỔI BẬT</div>
        </div>
        <div class="row Featured-products__list Featured-products__autoplay">
            <?php
                include '../database/config.php';
                $queryFeaturedProduct = "SELECT * FROM product WHERE quantity > 0 AND quantity_purchased > 0 ORDER BY quantity_purchased DESC LIMIT 0, 7";
                $resultFeaturedProduct = mysqli_query($conn, $queryFeaturedProduct);
                while ($rowFeaturedProduct = mysqli_fetch_array($resultFeaturedProduct)) {
                    echo 
                    '
                    <div class="Featured-products__item">
                        <a class="Featured-products__item-content" href="../pages/detailProduct.php?idProduct='.$rowFeaturedProduct['id'].'">
                            <img src="'.$rowFeaturedProduct['thumbnail'].'" alt="">
                            <div class="Featured-products__item-body">
                                <p>'.$rowFeaturedProduct['title'].'</p>
                                <p>'.number_format(ceil($rowFeaturedProduct["price"] - ($rowFeaturedProduct["price"] * $rowFeaturedProduct["discount"] / 100)), 0, '.', '.').'đ</p>
                                <div class="Featured-products__item-body-star">
                                    <hr>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <hr>
                                </div>
                                <div class="Featured-products__item-body-icon">
                                    <a href="../pages-handle/addFavoriteHandle.php?idProduct='.$rowFeaturedProduct['id'].'"><i class="fa-regular fa-heart"></i></a>
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                                <div class="Featured-products__item-body-func">
                                    <a href="../pages-handle/addCartHandle.php?idProduct='.$rowFeaturedProduct['id'].'" class="Featured-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </a>
                    </div>  
                    ';
                }
            ?>
        </div>
        
    </div>
</div>