<?php
$idProduct = $_GET['idProduct'];
include '../database/config.php';
$queryDetailProduct = "SELECT * FROM product WHERE id = $idProduct";
$resultDetailProduct = mysqli_query($conn, $queryDetailProduct);
$rowDetailProduct = mysqli_fetch_array($resultDetailProduct);
$titleDetailProduct = $rowDetailProduct['title'];
$thumbnailDetailProduct = $rowDetailProduct['thumbnail'];
$priceDetailProduct_root = $rowDetailProduct['price'];
$priceDetailProduct = $rowDetailProduct['price'] - ceil($rowDetailProduct['price'] * $rowDetailProduct['discount'] / 100);
$quantityDetailProduct = $rowDetailProduct['quantity'];
$quantityPurchasedDetailProduct = $rowDetailProduct['quantity_purchased'];
$discountDetailProduct = $rowDetailProduct['discount'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/slick.css">
    <link rel="stylesheet" href="../css/slick-theme.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/animation.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>
<?php include '../templates/header.php' ?>
<div class="content__detail-shoes">
    <div class="grid wide">
        <div class="row">
            <p class="content__detail-shoes-title"><?= $titleDetailProduct ?></p>
        </div>
        <div class="row">
            <div class="col l-4 m-12 C-12">
                <div class="product-img">
                    <img src="<?= $thumbnailDetailProduct ?>" alt="">
                </div>
            </div>
            <div class="col l-8 m-12 C-12">
                <div class="product-info">
                    <form action="../pages-handle/addCartHandle.php" method="post">
                        <div class="product-info-price">
                            <p><?= number_format($priceDetailProduct, 0, '.', '.') ?> VND
                                <?php if ($discountDetailProduct != NULL) { ?>
                                    <span class="product-info-discount"><?= number_format($priceDetailProduct_root, 0, '.', '.') ?> VND</span>
                                <?php } else {
                                    echo "";
                                } ?>
                                <?php if ($discountDetailProduct != NULL) { ?>
                                    <span class="product-info-percent">Giảm <?= $discountDetailProduct ?>%</span>
                                <?php } else {
                                    echo "";
                                } ?>
                            </p>
                            <p class="product-info-promotion"><i class="fa-sharp fa-solid fa-truck-fast"></i>Giao hàng siêu tốc, miễn phí đổi trả 7 ngày</p>
                            <p class="product-info-promotion"><i class="fa-solid fa-credit-card"></i>Giảm giá 5% khi thanh toán qua ngân hàng <img src="../images//logo//tpbank.jpg" alt=""></p>
                        </div>
                        <div class="product-info-amount">
                            <p>Số lượng: </p>
                            <span class="dec">-</span>
                            <span class="inc">+</span>
                            <input class="amount-product" name="amount-product" type="text" value="1">
                        </div>
                        <input type="text" name="idProduct" value="<?= $idProduct ?>" style="display: none;">
                        <div class="product-info-size">
                            <p>Kích thước: </p>
                            <button>36<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>37<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>38<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>39<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>40<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>41<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>42<div class="product-info-size-tick"><span>✓</span></div></button>
                            <button>43<div class="product-info-size-tick"><span>✓</span></div></button>
                        </div>
                        <div class="product-info-size">
                            <p>Đã bán: <?= $quantityPurchasedDetailProduct ?></p>
                        </div>
                        <div class="product-info-size">
                            <p>Tình trạng:
                                <?php
                                $$amountProduct = "";
                                if (!empty($_POST['amount-product'])) {
                                    $amountProduct = $_POST['amount-product'];
                                }
                                if ($quantityDetailProduct > 0) {
                                    echo
                                    '
                                còn ' . $quantityDetailProduct . ' </p>
                                </div>
                                <div class="product-info-action">
                                    <a href="../user/Index.php?page=Payment&idProduct=' . $idProduct . '">Mua ngay</a>
                                    <button type="submit"><i class="fa-solid fa-cart-shopping"></i>
                                        <p>Thêm vào giỏ hàng</p>
                                    </button>
                                </div>
                                ';
                                }
                                ?>

                        </div>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="col l-5 m-12 c-12">
                    <div class="product-info-detail1">

                        <p class="product-info-detail-des"><i class="fa-solid fa-store"></i>Hàng chính hãng, chất lượng cao</p>
                        <p class="product-info-detail-des"><i class="fa-solid fa-truck-fast"></i>Miễn phí giao hàng cho đơn hàng > 500.000 VND</p>
                        <p class="product-info-detail-des"><i class="fa-solid fa-rotate-left"></i>Chính sách đổi trả 30 ngày, thủ tục đơn giản</p>
                        <p class="product-info-detail-des"><i class="fa-solid fa-circle-check"></i>Bảo hành sản phẩm lên đến 12 tháng</p>
                    </div>
                </div>
                <div class="col l-7 m-12 c-12">
                    <img class="imgBanner" src="../images/logo/black-friday.jpg" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col l-7 m-12 c-12">
                    <div class="product-info-detail">
                        <p class="product-info-detail-title">Thông tin chi tiết</p>
                        <p class="product-info-detail-des">Air Jordan 1 KO Orange được xây dựng trong một kết cấu bằng vải với Swooshes bằng da và cổ chân có đế màu trắng với lớp phủ màu Cam Rush. Đế giữa của Cánh buồm trên đỉnh đế ngoài bằng cao su màu Cam hoàn thiện thiết kế.</p>
                    </div>
                </div>
                <div class="col l-5 m-12 c-12">
                    <div class="product-info-comment">
                        <div class="product-info-comment-content">
                            <?php
                            $queryDisplaySL = "SELECT count(fullname) sl FROM product p, feedback f, user u WHERE p.id = f.product_id AND u.id = f.user_id AND f.product_id = $idProduct";
                            $resultDisplaySL = mysqli_query($conn, $queryDisplaySL);
                            $rowDisplaySL = mysqli_fetch_array($resultDisplaySL);
                            echo
                            '
                                    <p class="product-info-comment-evaluate">Đánh giá (' . $rowDisplaySL['sl'] . ')</p>
                                ';
                            ?>
                            <div class="product-info-comment-user">
                                <?php
                                $queryDisplayCmt = "SELECT fullname,f.product_id ,f.content, month(comment_date) month, day(comment_date) day, year(comment_date) year, content_reply FROM product p, feedback f, user u WHERE p.id = f.product_id AND u.id = f.user_id AND f.product_id = $idProduct";
                                $resultDislayCmt = mysqli_query($conn, $queryDisplayCmt);
                                if ($resultDislayCmt->num_rows > 0) {
                                    while ($rowDisplayCmt = mysqli_fetch_array($resultDislayCmt)) {
                                        $name = explode(" ", $rowDisplayCmt['fullname']);
                                        echo
                                        '
                                            <div class="product-info-comment-user-content">
                                            <p class="product-info-comment-user-u">' . substr($name[count($name) - 1], 0, 1) . '</p>
                                            <div>
                                            <p>' . $rowDisplayCmt['fullname'] . '</p>
                                            <p>' . $rowDisplayCmt['day'] . ' thg ' . $rowDisplayCmt['month'] . ' ' . $rowDisplayCmt['year'] . '</p>
                                            </div>
                                            </div>
                                    
                                            <div class="product-info-comment-result">
                                                <p>' . $rowDisplayCmt['content'] . '</p>
                                            </div>
                                        ';
                                        if (isset($rowDisplayCmt['content_reply'])) {
                                            echo
                                            '
                                                <div class="reply">
                                                    <div class="reply__content">
                                                        <p class="reply__content--user">DB</p>
                                                        <div>
                                                            <p>Shop giày DABOTING</p>
                                                            <p>' . $rowDisplayCmt['day'] . ' thg ' . $rowDisplayCmt['month'] . ' ' . $rowDisplayCmt['year'] . '</p>
                                                        </div>
                                                    </div>
                                                    <div class="reply__result">
                                                        <p>' . $rowDisplayCmt['content_reply'] . '</p>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    }
                                }

                                ?>
                            </div>
                        </div>
                        <?php
                        if (!empty($_GET['status'])) {
                            if ($_GET['status'] == 'Đã giao hàng') {
                                echo
                                '
                                        <div class="product-info-comment-result">
                                            <form action="../pages-handle/commentHandle.php" method="post">
                                                <input type="text" name="content" placeholder="Đánh giá về sản phẩm..." required>
                                                <input type="text" name="idProduct" value="' . $idProduct . '" style="display: none;">
                                                <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                                            </form>
                                        </div>
                                    ';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <p class="content__detail-shoes-relate">Một số sản phẩm liên quan</p>
            <div class="row">
                <?php
                $queryConcernAmount = "SELECT count(id) AS 'sl' FROM product";
                $resultConcernAmount = mysqli_query($conn, $queryConcernAmount);
                $rowConcernAmount = mysqli_fetch_array($resultConcernAmount);
                $ConcernAmount = random_int(0, $rowConcernAmount['sl'] - 5);
                $queryConcernProduct = "SELECT * FROM product LIMIT $ConcernAmount,5";
                $resultConcernProduct = mysqli_query($conn, $queryConcernProduct);
                while ($rowConcernProduct = mysqli_fetch_array($resultConcernProduct)) {
                    echo
                    '
                    <div class="col l-2-4 m-4 c-6">
                        <div class="All-products__item">
                            <a href="../pages/detailProduct.php?idProduct=' . $rowConcernProduct['id'] . '" class="All-products__item-content">
                                <img src="' . $rowConcernProduct['thumbnail'] . '" alt="">
                                <div class="All-products__item-body">
                                    <p>' . $rowConcernProduct['title'] . '</p>
                                    <p>' . number_format($rowConcernProduct['price'], 0, '.', '.') . 'đ</p>
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
                                        <a href="../pages-handle/addFavoriteHandle.php?idProduct=' . $rowConcernProduct['id'] . '"><i class="fa-regular fa-heart"></i></a>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                    <div class="All-products__item-body-func">
                                        <a href="../pages-handle/addCartHandle.php?idProduct=' . $rowConcernProduct['id'] . '" class="All-products__item-body-func-add"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                ';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include '../templates/footer.php' ?>
    <script src="../js/main.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../js/slick.min.js"></script>
    <script src="../js/slick.js"></script>

</html>