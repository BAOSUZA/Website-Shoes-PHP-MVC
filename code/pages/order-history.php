<?php
$idUser = $_SESSION['IDUser'];
include '../database/config.php';
?>
<div class="cart">
    <div class="grid wide">
        <div class="row">
            <div class="col l-8">
                <div class="cart-detail">
                    <h3 class="cart-detail-title">Lịch sử đặt hàng</h3>
                </div>
                <div class="cart-content">
                    <table>
                        <thead class="history">
                            <tr>
                                <th>Đơn hàng</th>
                                <th>Số điện thoại</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Tổng tiền</th>
                                <th>Xem chi tiết</th>
                            </tr>
                        </thead>
                        <?php
                        $totalReceipt = 0;
                        $queryDisplayOrder = "SELECT * FROM orders WHERE user_id = $idUser";
                        $resultDisplayOrder = mysqli_query($conn, $queryDisplayOrder);
                        $i = 0;
                        if ($resultDisplayOrder->num_rows != 0) {
                            while ($rowDisplayOrder = mysqli_fetch_array($resultDisplayOrder)) {
                                $i += 1;
                                echo
                                '
                                    <tbody>
                                        <tr><td colspan="6"><hr></td></tr>
                                        <tr>
                                            <td>Đơn hàng thứ ' . $i . '</td>
                                            <td>' . $rowDisplayOrder['phone_number'] . '</td>
                                            <td>' . $rowDisplayOrder['order_date'] . '</td>
                                            <td>' . $rowDisplayOrder['status'] . '</td>
                                            <td>' . number_format($rowDisplayOrder['total_money'], 0, '.', '.') . 'đ</td>
                                            <td><a href="../user/index.php?page=History&idOrder=' . $rowDisplayOrder['id'] . '&stt=' . $i . '"><i class="fa-regular fa-eye"></i></a></td>
                                            </tr>
                                    </tbody>
                                ';
                            }
                        } else {
                            echo '<h2 style="color: red; text-align: center;">Bạn chưa có đơn hàng nào</h2>';
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col l-4 order-details" style="margin-top: 80px">
                <div class="order-summary">
                    <?php
                    $idOrder = 0;
                    $order = "";
                    if (!empty($_GET['idOrder'])) { 
                        $idOrder = $_GET['idOrder'];
                    }
                    if (!empty($_GET['stt'])) {
                        $order = "thứ ". $_GET['stt'];
                    }
                    $total = 0;
                    ?>
                    <div class="order-col1">
                        <div><strong>Chi tiết đơn hàng <?=$order?></strong></div>
                    </div>
                    <?php
                    $queryDisplayOrderDetail = "SELECT od.product_id, od.num, od.price, p.title, status FROM order_details od, product p, orders o WHERE od.product_id = p.id AND o.id = od.order_id AND o.user_id = $idUser AND order_id = $idOrder";
                    $resultDisplayOrderDetail = mysqli_query($conn, $queryDisplayOrderDetail);
                    while ($rowDisplayOrderDetail = mysqli_fetch_array($resultDisplayOrderDetail)) {
                        $total += $rowDisplayOrderDetail['num'] * $rowDisplayOrderDetail['price'];
                        echo
                        '
                        <div class="order-col">
                            <div><a href="../pages/detailProduct.php?idProduct=' . $rowDisplayOrderDetail['product_id'] . '&status='.$rowDisplayOrderDetail['status'].'">' . $rowDisplayOrderDetail['title'] . '</a></div>
                            <div>' . $rowDisplayOrderDetail['num'] . ' x ' . number_format($rowDisplayOrderDetail['price'], 0, '.', '.') . 'đ</div>
                        </div>
                        ';
                    }
                    ?>
                    <hr style="border: 0; border-top: 2px solid #bababa; margin: 20px 0;">
                    <div class="order-col">
                        <div><strong>Tổng tiền</strong></div>
                        <div><strong class="order-total" id="tongTien-GioHang"><?= number_format($total, 0, '.', '.') ?>đ</strong></div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>