<?php
session_start();
$idUser = $_SESSION['IDUser'];
include '../database/config.php';
if (!empty($_GET)) {
    $idProduct = $_GET['idProduct'];
}
$queryAddFavorite = "DELETE FROM favorite WHERE product_id = $idProduct AND user_id = $idUser";
mysqli_query($conn, $queryAddFavorite);
header("location: ../user/index.php?page=Favorite");
?>