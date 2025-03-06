<?php
include '../database/config.php';
if (!empty($_SESSION)) {
    $idUser = $_SESSION['IDUser'];
}
$idOrderDetailSend = "";
?>
<div class="payment">
    <form action="../pages-handle/paymentHandle.php" method="POST">
        <div class="grid wide">
            <div class="row">
                <div class="col l-7">
                    <div class="billing-details">
                        <div class="billing-details-title">
                            <h3 class="title">Địa chỉ thanh toán</h3>
                        </div>
                        <input class="input-ThanhToan" type="text" id="name" name="name" placeholder="Họ tên" value="" required>
                        <input class="input-ThanhToan" type="text" id="address" name="address" placeholder="Địa chỉ" value="" required>
                        <input class="input-ThanhToan" type="number" id="phone" name="phone" placeholder="Số điện thoại" value="" required>
                        <input class="input-ThanhToan" type="email" id="email" name="email" placeholder="Email" value="" required>
                    </div>
                </div>
                <div class="col l-5 order-details">
                    <div class="order-details-title">
                        <h3 class="title">Đơn hàng</h3>
                    </div>

                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>Sản phẩm</strong></div>
                            <div><strong>Tổng</strong></div>
                        </div>
                        <div class="order-products">
                            <?php
                            $totalMoneyOrder = 0;
                            if (!empty($_GET['idOrderDetail'])) {
                                $idOrderDetail = $_GET['idOrderDetail'];
                                foreach (explode(' ', $idOrderDetail) as $key => $value) {
                                    $queryDisplayOrder = "SELECT *, od.price AS priceOrder, od.id AS idOrderDetail FROM order_details od, product p WHERE od.product_id = p.id AND od.id = $value AND user_id = $idUser";
                                    $resultDisplayOrder = mysqli_query($conn, $queryDisplayOrder);
                                    $rowDisplayOrder = mysqli_fetch_array($resultDisplayOrder);
                                    $totalMoneyOrder += $rowDisplayOrder['total_money'];
                                    $idOrderDetailSend .= $rowDisplayOrder['idOrderDetail'] . " ";
                                    echo
                                    '
                                        <div class="order-col">
                                            <div><a href="../pages/detailProduct.php?idProduct='.$rowDisplayOrder['product_id'].'">' . $rowDisplayOrder['title'] . '</a></div>
                                            <div>' . $rowDisplayOrder['num'] . ' x ' . number_format($rowDisplayOrder['priceOrder'], 0, '.', '.') . 'đ</div>
                                        </div>
                                    ';
                                }
                            }
                            if (empty($_GET['idOrderDetail']) && empty($_GET['idProduct'])) {
                                $queryDisplayOrder = "SELECT *, od.price AS priceOrder, od.id AS idOrderDetail FROM order_details od, product p WHERE od.product_id = p.id AND user_id = $idUser AND od.order_id IS NULL";
                                $resultDisplayOrder = mysqli_query($conn, $queryDisplayOrder);
                                while ($rowDisplayOrder = mysqli_fetch_array($resultDisplayOrder)) {
                                    $idOrderDetailSend .= $rowDisplayOrder['idOrderDetail'] . " ";
                                    echo
                                    '
                                        <div class="order-col">
                                            <div><a href="../pages/detailProduct.php?idProduct='.$rowDisplayOrder['product_id'].'">' . $rowDisplayOrder['title'] . '</a></div>
                                            <div>' . $rowDisplayOrder['num'] . ' x ' . number_format($rowDisplayOrder['priceOrder'], 0, '.', '.') . 'đ</div>
                                        </div>
                                    ';
                                    $totalMoneyOrder += $rowDisplayOrder['total_money'];
                                }
                            }
                            if (!empty($_GET['idProduct'])) {
                                $idProduct = $_GET['idProduct'];
                                $queryDisplayOrder = "SELECT * FROM product WHERE id = $idProduct";
                                $resultDisplayOrder = mysqli_query($conn, $queryDisplayOrder);
                                $idOrderDetailSend = 1;
                                while ($rowDisplayOrder = mysqli_fetch_array($resultDisplayOrder)) {
                                    $priceProduct = $rowDisplayOrder['price'] - ceil($rowDisplayOrder['price'] * $rowDisplayOrder['discount'] / 100);
                                    echo
                                    '
                                        <div class="order-col">
                                            <div><a href="../pages/detailProduct.php?idProduct='.$rowDisplayOrder['id'].'">' . $rowDisplayOrder['title'] . '</a></div>
                                            <div>1 x ' .number_format(($rowDisplayOrder['price'] - ceil($rowDisplayOrder['price'] * $rowDisplayOrder['discount'] / 100)), 0, '.', '.')  . 'đ</div>
                                        </div>
                                        <input type="text" name="priceProductSend" value="'.$priceProduct.'" style="display: none;">
                                        <input type="text" name="idProductSend" value="'.$idProduct.'" style="display: none;">
                                    ';
                                    $totalMoneyOrder = ($rowDisplayOrder['price'] - ceil($rowDisplayOrder['price'] * $rowDisplayOrder['discount'] / 100));
                                }
                            }
                            ?>
                            <input type="text" name="idOrderDetailSend" value="<?=$idOrderDetailSend?>" style="display: none;">
                        </div>
                        <div class="order-col">
                            <div>Phí vận chuyển</div>
                            <div><strong>Miễn phí</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>Tổng tiền</strong></div>
                            <div><strong class="order-total"><?= number_format($totalMoneyOrder, 0, '.', '.') ?>đ</strong></div>
                        </div>
                    </div>

                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1" checked>
                            <label for="payment-1">
                                <span></span>
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Thẻ tín dụng
                            </label>

                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
                            <label for="payment-3">
                                <span></span>
                                Ví MOMO
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="checkout-submit" name="total" value="<?=$totalMoneyOrder?>">Thanh toán</button>
                </div>
            </div>
        </div>
    </form>
</div>