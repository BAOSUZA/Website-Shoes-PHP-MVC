<?php
session_start();
$idUser = $_SESSION['IDUser'];
include '../database/config.php';
if (!empty($_GET)) {
    $idProduct = $_GET['idProduct'];
}
$queryAddFavorite = "INSERT INTO `favorite` (`product_id`, `user_id`) VALUES ('$idProduct', '$idUser')";
mysqli_query($conn, $queryAddFavorite);
header("location: ../user/index.php");
?>