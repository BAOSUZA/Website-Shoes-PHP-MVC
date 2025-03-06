<?php
$idUser = $_SESSION['IDUser'];
include '../database/config.php';
?>
<div class="cart">
    <div class="grid wide">
        <div class="row">
            <div class="col l-12 m-12 c-12">
                <div class="cart-detail">
                    <h3 class="cart-detail-title">Sản phẩm yêu thích</h3>
                </div>
                <div class="cart-content">
                    <table>
                        <?php
                    $queryDisplayCarts = "SELECT * FROM favorite f, product p WHERE p.id = f.product_id AND f.user_id = $idUser";
                    $resultDisplayCarts = mysqli_query($conn, $queryDisplayCarts);
                    if ($resultDisplayCarts->num_rows != 0) {
                        echo 
                        '
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th></th>
                                </tr>
                            </thead>
                        ';
                        while ($rowDisplayCarts = mysqli_fetch_array($resultDisplayCarts)) {
                            echo
                            '
                                <tbody>
                                    <tr><td colspan="4"><hr></td></tr>
                                    <tr>
                                        <td class="image-favorite">
                                            <img src="' . $rowDisplayCarts['thumbnail'] . '" alt="">
                                        </td>
                                        <td>
                                        <div class="cart-content-title"><a href="../pages/detailProduct.php?idProduct='.$rowDisplayCarts['product_id'].'">' . $rowDisplayCarts['title'] . '</a></div>
                                        </td>
                                        <td>' . number_format(ceil($rowDisplayCarts['price'] - ($rowDisplayCarts['price'] * $rowDisplayCarts['discount']) / 100), 0, '.', '.') . 'đ</td>
                                        <td>
                                            <div class="cart-content-cancel">
                                                <a href="../pages-handle/removeFavoriteHandle.php?idProduct='.$rowDisplayCarts['product_id'].'"><i class="fa-solid fa-xmark"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                ';
                            }
                        } else {
                            echo '<h2 style="color: red; text-align: center;">Bạn chưa có sản phẩm yêu thích nào</h2>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>