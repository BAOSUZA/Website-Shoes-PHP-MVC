<?php
    include "../config.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE id = $id";
    mysqli_query($conn, $sql);
    header("location: ../index.php?page=Product");
?>