<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="stylesheet" href="../css/slick.css">
    <link rel="stylesheet" href="../css/slick-theme.css">
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/animation.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>Document</title>
</head>

<?php include '../templates/header.php' ?>

<?php
if (isset($_GET["page"]))
    $page = $_GET["page"];
else
    $page = "Index";
switch ($page) {
    case 'Index':
        include '../pages/home.php';
        break;
    case 'Introduct':
        include '../pages/introduct.php';
        break;
    case 'Product':
        include '../pages/product.php';
        break;
    case 'Contact':
        include '../pages/contact.php';
        break;
    case 'Login':
        include '../pages/login.php';
        break;
    case 'Register':
        include '../pages/register.php';
        break;
    case 'DetailProduct':
        include '../pages/detailProduct.php';
        break;
    case 'Cart':
        include '../pages/cart.php';
        break;
    case 'Favorite':
        include '../pages/favorite.php';
        break;
    case 'History':
        include '../pages/order-history.php';
        break;
    case 'Payment':
        include '../pages/payment.php';
        break;
    case 'Search':
        include '../pages-handle/searchHandle.php';
        break;
    default:
        include '../pages/home.php';
        break;
}

?>

<?php include '../templates/footer.php' ?>

<script src="../js/main.js"></script>
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery-migrate-1.2.1.min.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/slick.js"></script>

</html>