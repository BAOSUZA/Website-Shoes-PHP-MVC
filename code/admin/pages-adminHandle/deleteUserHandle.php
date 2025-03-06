<?php
include "../config.php";
if (!empty($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
    $sql = "DELETE FROM user WHERE id = $idUser";
    mysqli_query($conn, $sql);
    $query2 = "SELECT * FROM user WHERE id = $idUser";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    if ($row['role_id'] == 2) {
        header("location: ../index.php?page=User");
    } else {
        header("location: ../index.php?page=Admin");
    }
}
