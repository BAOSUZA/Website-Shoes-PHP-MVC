<?php
    session_start();
    $idUser = $_SESSION['IDUser'];
    include '../database/config.php';
    if (!empty($_POST)) {
        $content = $_POST['content'];
        $idProduct = $_POST['idProduct'];
    }
    $queryInsert = "INSERT INTO `feedback` (`user_id`, `product_id`, `content`, `comment_date`) 
                    VALUES ('$idUser', '$idProduct', '$content', CURRENT_TIMESTAMP())";
    mysqli_query($conn, $queryInsert);
    header("location: ../pages/detailProduct.php?idProduct=$idProduct&status=Đã giao hàng");
?>