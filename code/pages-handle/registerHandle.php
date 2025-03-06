<?php
if (!empty($_POST)) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    include('../database/config.php');
    if ($password == $repassword) {
        $query = " INSERT INTO `user` (`fullname`, `email`, `phone_number`, `address`, `password`, `role_id`) 
                    VALUES ('$fullname', '$email', '$phonenumber', '$address', '$password', '2')";
        mysqli_query($conn, $query);
        header('location: ../user/index.php?page=Register');
    }
}