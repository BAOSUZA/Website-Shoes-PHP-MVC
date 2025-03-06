<?php
session_start();
include '../database/config.php';
$idUser = $_SESSION['IDUser'];
$idProductCart = $_GET['idProductCart'];
$queryDeleteCart = "DELETE FROM order_details WHERE id = $idProductCart AND user_id = $idUser";
mysqli_query($conn, $queryDeleteCart);
header("location: ../user/index.php?page=Cart")
?>
