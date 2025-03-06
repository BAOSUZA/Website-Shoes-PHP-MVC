<?php
    session_start();
    include '../database/config.php';
    $idUser = $_SESSION['IDUser'];
    $quantity = $idProductReceive = "";
    if (!empty($_GET['idProduct'])) {
        $quantity = 1;
        $idProductReceive = $_GET['idProduct'];
    }
    if (!empty($_POST)) {
        $quantity = $_POST['amount-product'];
        $idProductReceive = $_POST['idProduct'];
    }
    $querydisplay = "SELECT * FROM product WHERE id = $idProductReceive";
    $resultdisplay = mysqli_query($conn, $querydisplay);
    $rowdisplay = mysqli_fetch_array($resultdisplay);
    $price = $rowdisplay['price'] - ceil($rowdisplay['price'] * $rowdisplay['discount'] / 100);
    // Thêm vào giỏ hàng
    $queryCheckCart = "SELECT * FROM `order_details` WHERE `product_id` = $idProductReceive AND `user_id` = $idUser  AND `order_id` IS NULL";
    echo $queryCheckCart . '<br>';
    $resultCheckCart = mysqli_query($conn, $queryCheckCart);
    echo $resultCheckCart->num_rows . '<br>';
    if (($resultCheckCart->num_rows) != 0) {
        $queryOrder_Detail = "UPDATE `order_details` SET `num` = `num` + $quantity, `total_money` = `price` * `num` 
                            WHERE `product_id` = $idProductReceive AND `user_id` = $idUser";
        mysqli_query($conn, $queryOrder_Detail);
        header("location: ../user/index.php");
    } else {
        $queryOrder_Detail = "INSERT INTO `order_details` (`user_id` , `product_id`, `price`, `num`, `total_money`) 
                            VALUES ('$idUser', '$idProductReceive', '$price', '$quantity', `price` * `num`)";
        mysqli_query($conn, $queryOrder_Detail);
        header("location: ../user/index.php");
    }
    echo $queryOrder_Detail;
?>