<?php
session_start();
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    include('../database/config.php');
    $sql = "SELECT * FROM user WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows != 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['IDUser'] = $row['id'];
        $_SESSION['UserName'] = $row['fullname'];
        if ($row['role_id'] == 2)
            $_SESSION['Role'] = 'Người dùng';
        else
            $_SESSION['Role'] = 'Admin';
        header('location: ../user/index.php');
    } else {
        echo 'lỗi';
    }
}
