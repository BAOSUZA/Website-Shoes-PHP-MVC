<?php
$idUser = $_SESSION['IDUser'];
include '../database/config.php';
?>
<div class="cart">
    <div class="grid wide">
        <div class="row">
            <div class="col l-8">
                <div class="cart-detail">
                    <h3 class="cart-detail-title">Giỏ hàng</h3>
                </div>
                <form method="POST">
                    <div class="cart-content">
                        <table>
                            <?php
                            $totalReceipt = 0;
                            $queryDisplayCarts = "SELECT *, od.id AS id_order_detail FROM order_details od, product p WHERE p.id = od.product_id AND od.user_id = $idUser AND od.order_id IS NULL";
                            $resultDisplayCarts = mysqli_query($conn, $queryDisplayCarts);
                            $quantytiProductCarts = $resultDisplayCarts->num_rows - 1;
                            if ($resultDisplayCarts->num_rows != 0) {
                                $idOrderDetail = "";
                                echo
                                '
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th>
                                        <th>Kích cỡ</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            ';
                                while ($rowDisplayCarts = mysqli_fetch_array($resultDisplayCarts)) {
                                    $idOrderDetail .= $rowDisplayCarts['id_order_detail'] . " ";
                                    echo
                                    '
                                <tbody>
                                <tr><td colspan="8"><hr></td></tr>
                                <tr>
                                    <td>
                                        <input class="checkboxCart" type="checkbox" value="' . $rowDisplayCarts['id_order_detail'] . '">
                                    </td>
                                    <td>
                                        <img src="' . $rowDisplayCarts['thumbnail'] . '" alt="">
                                    </td>
                                    <td>
                                        <div class="cart-content-title"><a href="../pages/detailProduct.php?idProduct=' . $rowDisplayCarts['id'] . '">' . $rowDisplayCarts['title'] . '</a></div>
                                    </td>
                                    <td>' . number_format(ceil($rowDisplayCarts['price'] - ($rowDisplayCarts['price'] * $rowDisplayCarts['discount']) / 100), 0, '.', '.') . 'đ</td>
                                    <td>38</td>
                                    <td>
                                        <div class="cart-content-quantity">
                                            <div class=" qtybutton"><a href="../pages-handle/updateCartHandle.php?quantity=dec&idOrderDetail=' . $rowDisplayCarts['id_order_detail'] . '">-</a></div>
                                            <input class="qty-product cart-plus-minus-box" type="text" name="qtybutton" value="' . $rowDisplayCarts['num'] . '">
                                            <div class=" qtybutton"><a href="../pages-handle/updateCartHandle.php?quantity=inc&idOrderDetail=' . $rowDisplayCarts['id_order_detail'] . '">+</a></div>
                                        </div>
                                    </td>
                                    <td>' . number_format($rowDisplayCarts['total_money'], 0, '.', '.') . 'đ</td>
                                    <td>
                                        <div class="cart-content-cancel">
                                            <a href="../pages-handle/deleteCartHandle.php?idProductCart=' . $rowDisplayCarts['id_order_detail'] . '"><i class="fa-solid fa-xmark"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                                ';
                                }
                            } else {
                                echo '<h2 style="color: red; text-align: center;">Bạn chưa có sản phẩm nào trong giỏ hàng</h2>';
                            }
                            ?>
                        </table>
                    </div>
                    <input class="idOrderDetail" name="idOrderDetail" type="text" value="" style="display: none;">
                    <input class="checkboxCartAll" type="checkbox" name="idOrderDetailAll" value="<?=$idOrderDetail?>"> Chọn tất cả
                    <input class="create-receipt" type="submit" name="creReceipt" value="Tạo hóa đơn">
                </form>
            </div>

            <?php
            if (!empty($_POST['creReceipt'])) {
                if (isset($_POST['idOrderDetail'])) {
                    $idOrderDetail = $_POST['idOrderDetail'];
                }
                if (isset($_POST['idOrderDetailAll'])) {
                    $idOrderDetail = $_POST['idOrderDetailAll'] . " ";
                }
                $listIDOD = explode(" ", $idOrderDetail);
            }
            ?>
            <div class="col l-4 order-details" style="margin-top: 80px">
                <div class="order-summary">
                    <?php
                    if (!empty($_POST['creReceipt'])) {
                        foreach ($listIDOD as $key => $value) {
                            if ($key < (count($listIDOD) - 2)) {
                                $queryListReceipt = "SELECT *, od.price AS 'priceProduct' FROM order_details od, product p WHERE p.id = od.product_id AND od.user_id = $idUser AND od.id = $value";
                                $resultListReceipt = mysqli_query($conn, $queryListReceipt);
                                while ($rowListReceipt = mysqli_fetch_array($resultListReceipt)) {
                                    $priceProduct = $rowListReceipt['priceProduct'];
                                    $totalReceipt += $rowListReceipt['total_money'];
                                    echo
                                    '
                                    <div class="order-col">
                                        <div><strong>'.$rowListReceipt['title'].'</strong></div>
                                        <div>'.$rowListReceipt['num']. ' x '.number_format($priceProduct, 0, '.', '.') .'</div>
                                    </div>
                                    ';
                                }
                            }
                        }
                    }
                    ?>
                    <div class="order-col">
                        <div><strong>Phí vận chuyển</strong></div>
                        <div>Miễn phí</div>
                    </div>
                    <div class="order-col">
                        <div><strong>Tạm tính</strong></div>
                        <div>
                            <?= number_format($totalReceipt, 0, '.', '.') ?>đ
                        </div>
                    </div>
                    <hr style="border: 0; border-top: 2px solid #bababa; margin: 20px 0;">
                    <div class="order-col">
                        <div><strong>Tổng tiền</strong></div>
                        <div><strong class="order-total" id="tongTien-GioHang"><?= number_format($totalReceipt, 0, '.', '.') ?>đ</strong></div>
                    </div>
                </div>
                <span class="check-out">
                    <a href="../user/index.php?page=Payment&idOrderDetail=<?= $idOrderDetail ?>">Thanh toán</a>
                </span>
                </a>
            </div>
        </div>
    </div>
</div>