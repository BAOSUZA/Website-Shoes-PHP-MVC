<?php
include("../config.php");
$upload_dir_men = '../images/product/men/';
$upload_dir_women = '../images/product/women/';
$upload_dir_kids = '../images/product/kids/';
$upload_dir_other = '../images/product/other/';
if (!empty($_POST)) {
    $ImgName = $_FILES['thumbnail']['name'];
    $ImgName_temp = $_FILES['thumbnail']['name_temp'];
    $category_Id = $_POST['category_Id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    echo $ImgName . '<br>';
    echo $category_Id . '<br>';
    echo $title . '<br>';
    echo $price . '<br>';
    echo $discount . '<br>';
    echo $description . '<br>';
    echo $quantity;
    echo "INSERT INTO `product` (`category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `quantity`, `quantity_purchased`) VALUES ('$category_Id', '$title', '$price', '$discount', '$upload_dir_men" . $ImgName . "', '$description', '$quantity', '0')";

    if ($category_Id == 1) {
        $query = "INSERT INTO `product` (`category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `quantity`, `quantity_purchased`) VALUES ('$category_Id', '$title', '$price', '$discount', '$upload_dir_men" . $ImgName . "', '$description', '$quantity', '0')";
        $kq = mysqli_query($conn, $query);
        move_uploaded_file($ImgName_temp, $upload_dir_men . $ImgName);
    }
    if ($category_Id == 2) {
        $query = "INSERT INTO `product` (`category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `quantity`, `quantity_purchased`) VALUES ('$category_Id', '$title', '$price', '$discount', '$upload_dir_women" . $ImgName . "', '$description', '$quantity', '0')";
        $kq = mysqli_query($conn, $query);
        move_uploaded_file($ImgName_temp, $upload_dir_women . $ImgName);
    }
    if ($category_Id == 3) {
        $query = "INSERT INTO `product` (`category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `quantity`, `quantity_purchased`) VALUES ('$category_Id', '$title', '$price', '$discount', '$upload_dir_kids" . $ImgName . "', '$description', '$quantity', '0')";
        $kq = mysqli_query($conn, $query);
        move_uploaded_file($ImgName_temp, $upload_dir_kids . $ImgName);
    }
    if ($category_Id == 4) {
        $query = "INSERT INTO `product` (`category_id`, `title`, `price`, `discount`, `thumbnail`, `description`, `quantity`, `quantity_purchased`) VALUES ('$category_Id', '$title', '$price', '$discount', '$upload_dir_other" . $ImgName . "', '$description', '$quantity', '0')";
        $kq = mysqli_query($conn, $query);
        move_uploaded_file($ImgName_temp, $upload_dir_other . $ImgName);
    }
}
header("location: ../index.php?page=Product");
?>