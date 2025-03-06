<?php
if (!empty($_POST)) {
    include("../config.php");
    $upload_dir_men = '../images/product/men/';
    $upload_dir_women = '../images/product/women/';
    $upload_dir_kids = '../images/product/kids/';
    $upload_dir_other = '../images/product/other/';
    $Product_ID = $_POST['Product_ID'];
    $category_Id = $_POST['category_Id'];
    $file = $_FILES['thumbnail']['name'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    if (isset($_POST['discount'])) {
        $discount = $_POST['discount'];
    }
    $quantity = $_POST['quantity'];

    if ($category_Id == 1) {
        if ($file == NULL) {
            $query = "UPDATE product SET category_Id = $category_Id, title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            echo $query;
            $kq = mysqli_query($conn, $query);
        } else {
            $query = "UPDATE product SET category_Id = $category_Id, thumbnail = '$upload_dir_men" . $file . "', title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir_men . $file);
        }
    }
    if ($category_Id == 2) {
        if ($file == NULL) {
            $query = "UPDATE product SET category_Id = $category_Id, title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
        } else {
            $query = "UPDATE product SET category_Id = $category_Id, thumbnail = '$upload_dir_women" . $file . "', title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir_women . $file);
        }
    }
    if ($category_Id == 3) {
        if ($file == NULL) {
            $query = "UPDATE product SET category_Id = $category_Id, title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
        } else {
            $query = "UPDATE product SET category_Id = $category_Id, thumbnail = '$upload_dir_kids" . $file . "', title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir_kids . $file);
        }
    }
    if ($category_Id == 4) {
        if ($file == NULL) {
            $query = "UPDATE product SET category_Id = $category_Id, title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
        } else {
            $query = "UPDATE product SET category_Id = $category_Id, thumbnail = '$upload_dir_other" . $file . "', title = '$title', price = $price, discount = $discount, quantity = $quantity WHERE id = $Product_ID;";
            $kq = mysqli_query($conn, $query);
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir_other . $file);
        }
    }
    header("location: ../index.php?page=Product");
}
