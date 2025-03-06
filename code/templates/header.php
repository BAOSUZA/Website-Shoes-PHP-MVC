<?php 
session_start(); 
include '../database/config.php'; 
if (!empty($_SESSION)) {
    $idUser = $_SESSION['IDUser'];
}
?>
<div>
    <div id="header">
        <div class="header__top">
            <div class="grid wide">
                <div class="row">
                    <div class="col l-3 m-12 c-12">
                        <div class="header__logo">
                            <img class="header__logo-img" src="../images/logo/logo.png" alt="">
                            <img class="header__logo-title" src="../images/logo/name.png" alt="">
                        </div>
                    </div>
                    <div class="col m-2 c-3 header__menu">
                        <label for="nav-mobile-input" class="header__nav-bars">
                            <p><i class="fa-solid fa-bars"></i><br>TRANG CHỦ</p>
                        </label>
                        <input type="checkbox" hidden name="" class="nav__input" id="nav-mobile-input">
                        <label for="nav-mobile-input" class="header__overlay-nav"></label>
                        <div class="header__mobile-nav">
                            <label for="nav-mobile-input" class="nav__mobile-close">
                                <i class="fa-solid fa-xmark"></i>
                            </label>
                            <ul class="nav__mobile-list">
                                <li>
                                    <i class="fa-solid fa-house"></i>
                                    <a href="../user/index.php?page=Index" class="nav__mobile-link">TRANG CHỦ</a>
                                </li>
                                <li>
                                    <i class="fa-sharp fa-solid fa-person"></i>
                                    <a href="../user/index.php?page=Introduct" class="nav__mobile-link">GIỚI THIỆU</a>
                                </li>
                                <li>
                                    <i class="fa-sharp fa-solid fa-person"></i>
                                    <a href="../user/index.php?page=Product" class="nav__mobile-link">GIÀY NAM</a>
                                </li>
                                <li>
                                    <i class="fa-solid fa-person-dress"></i>
                                    <a href="../user/index.php?page=Product" class="nav__mobile-link">GIÀY NỮ</a>
                                </li>
                                <li>
                                    <i class="fa-solid fa-child"></i>
                                    <a href="../user/index.php?page=Product" class="nav__mobile-link">GIÀY TRẺ EM</a>
                                </li>
                                <li>
                                    <i class="fa-sharp fa-solid fa-person"></i>
                                    <a href="../user/index.php?page=Product" class="nav__mobile-link">SẢN PHẨM KHÁC</a>
                                </li>
                                <li>
                                    <i class="fa-sharp fa-solid fa-person"></i>
                                    <a href="" class="nav__mobile-link">TIN TỨC</a>
                                </li>
                                <li>
                                    <i class="fa-solid fa-id-card"></i>
                                    <a href="../user/index.php?page=Contact" class="nav__mobile-link">LIÊN HỆ VỚI CHÚNG TÔI</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col l-7 m-7 c-4">
                        <form action="../user/index.php?page=Search" class="header__search" method="post">
                            <input type="text" name="content" placeholder="Tìm sản phẩm mong muốn....">
                            <input type="submit" value="Tìm kiếm">
                        </form>
                    </div>
                    <div class="col l-2 m-3 c-4">
                        <div class="header__user-and__cart">
                            <label for="cart-mobile-input">
                                <p><i class="fa-solid fa-cart-shopping"></i><br>Giỏ hàng</p>
                            </label>
                            <input type="checkbox" hidden name="" class="cart__input" id="cart-mobile-input">
                            <label for="cart-mobile-input" class="header__overlay-cart"></label>
                            <div class="header__cart">
                                <div class="header__cart-product">
                                    <div class="cart-product-list">
                                        <?php
                                            $amountProduct = $totalMoney = 0;
                                            if (!empty($_SESSION['Role'])) {    
                                                $queryCart = "SELECT *, p.price AS priceProduct FROM `order_details` od, product p WHERE od.product_id = p.id AND od.user_id = $idUser AND od.order_id IS NULL";
                                                $resulcart = mysqli_query($conn, $queryCart);
                                                $amountProduct = $resulcart->num_rows;
                                                while ($rowCart = mysqli_fetch_array($resulcart)) {
                                                    $totalMoney +=  $rowCart['total_money'];
                                                    echo 
                                                    '
                                                        <div class="cart-product-item">
                                                            <img src="'.$rowCart['thumbnail'].'" alt="">
                                                            <div class="cart-product-item-info">
                                                                <a href="../pages/detailProduct.php?idProduct='.$rowCart['id'].'">'.$rowCart['title'].'</a>
                                                                <p>'.$rowCart['num'].' x <b>'.number_format(ceil($rowCart['priceProduct'] - ($rowCart['priceProduct'] * $rowCart['discount'])/100), 0, '.', '.').'đ</b></p>
                                                            </div>
                                                        </div>
                                                    ';
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="header__cart-payment">
                                    <p>Có <?=$amountProduct?> sản phẩm</p>
                                    <p>Tạm tính: <?=number_format($totalMoney, 0, '.', '.')?>đ</p>
                                    <div class="header__cart-payment-func">
                                        <a href="../user/index.php?page=Cart">Xem giỏ hàng</a>
                                        <a href="../user/index.php?page=Payment">Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                            <label for="user-mobile-input">
                                <?php
                                    if (!empty($_SESSION['Role'])) {
                                        echo '<p><i class="fa-solid fa-user"></i><br>'.$_SESSION['UserName'].'</p>';
                                    }else {
                                        echo '<p><i class="fa-solid fa-user"></i><br>Tài khoản</p>';
                                    }
                                ?>
                            </label>
                            <input type="checkbox" hidden name="" class="user__input" id="user-mobile-input">
                            <label for="user-mobile-input" class="header__overlay-user"></label>
                            <div class="header__user">
                                <label for="user-mobile-input" class="user__mobile-close"><i
                                        class="fa-solid fa-xmark"></i></label>
                                <div class="header__user-func">
                                <?php
                                    if (!empty($_SESSION['Role'])) {
                                        if ($_SESSION['Role'] == 'Admin') {
                                            echo '<a href="../admin/index.php">Quyền quản lý admin</a>';
                                        }
                                        echo '<a href="">Thông tin tài khoản</a>
                                            <a href="../user/index.php?page=Favorite">Sản phẩm yêu thích</a>
                                            <a href="../user/index.php?page=History">Lịch sử đặt hàng</a>
                                            <a href="../pages-handle/logoutHandle.php">Đăng xuất</a>';
                                    }else {
                                        echo '<a href="../user/index.php?page=Login">Đăng nhập</a>
                                            <a href="../user/index.php?page=Register">Đăng ký</a>';
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__nav">
            <div class="header__nav--list">
                <div class="header__nav--item">
                    <a href="../user/index.php?page=Index" class="header__nav--link">TRANG CHỦ</a>
                </div>
                <div class="header__nav--item">
                    <a href="../user/index.php?page=Introduct" class="header__nav--link ">GIỚI THIỆU</a>
                </div>
                <div class="header__nav--item">
                <a href="../user/index.php?page=Product&category=1" class="header__nav--link">GIÀY NAM</a>
                </div>
                <div class="header__nav--item">
                <a href="../user/index.php?page=Product&category=2" class="header__nav--link">GIÀY NỮ</a>
                </div>
                <div class="header__nav--item">
                <a href="../user/index.php?page=Product&category=3" class="header__nav--link">GIÀY TRẺ EM</a>
                </div>
                <div class="header__nav--item">
                    <a href="../user/index.php?page=Product&category=4" class="header__nav--link">SẢN PHẨM KHÁC</a>
                </div>
                <!-- <div class="header__nav--item">
                    <a href="" class="header__nav--link">TIN TỨC</a>
                </div> -->
                <div class="header__nav--item">
                    <a href="../user/index.php?page=Contact" class="header__nav--link">LIÊN HỆ VỚI CHÚNG TÔI</a>
                </div>
            </div>
        </div>
    </div>
</div>