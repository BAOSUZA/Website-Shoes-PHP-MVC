<?php
include ("../config.php");
if (!empty($_POST)) {
    $idUser = $_POST['iduser'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $query = "UPDATE user SET  fullname  = '$fullname', email = '$email', phone_number = $phone_number, address = '$address', password = '$password', role_id = '$role_id' where id = $idUser";
    mysqli_query($conn, $query);
    $query2 = "SELECT * FROM user WHERE id = $idUser";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_array($result2);
    if ($row['role_id'] == 2) {
        header("location: ../index.php?page=User");   
    }else {
        header("location: ../index.php?page=Admin");   
    }
}
?>
