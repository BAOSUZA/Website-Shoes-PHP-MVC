<?php
    session_start();
    $idUser = $_SESSION['IDUser'];
    include '../database/config.php';
    $option = $_GET['quantity'];
    $idOrderProduct = $_GET['idOrderDetail'];
    if ($option == 'dec') {
        $queryUpdateQuantity = "UPDATE order_details SET num = num - 1, total_money = num * price WHERE user_id = $idUser AND id = $idOrderProduct";
    }else if ($option == 'inc') {
        $queryUpdateQuantity = "UPDATE order_details SET num = num + 1, total_money = num * price WHERE user_id = $idUser AND id = $idOrderProduct";
    }
    mysqli_query($conn, $queryUpdateQuantity);
    header("location: ../user/index.php?page=Cart");
?>