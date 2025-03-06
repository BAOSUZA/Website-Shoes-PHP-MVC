<?php
session_start();
$userName = "";
if (!empty($_SESSION['UserName'])) {
    $userName = $_SESSION['UserName'];
}
include '../admin/pages-admin/headerAdmin.php';
if (isset($_GET["page"]))
    $page = $_GET["page"];
else
    $page = "Index";
switch ($page) {
        // Trang chủ
    case 'Index':
        include '../admin/pages-admin/home.php';
        break;

        // Quản lý người dùng
    case 'User':
        include '../admin/pages-admin/userManagement.php';
        break;
    case 'Admin':
        include '../admin/pages-admin/adminManagement.php';
        break;
    case 'editUser':
        include "../admin/pages-admin/editUser.php";
        break;

        // Quản lý danh mục
    case 'Category':
        include '../admin/pages-admin/category.php';
        break;
    case 'addCategory':
        include '../admin/pages-admin/addCategory.php';
        break;
    case 'editCategory':
        include '../admin/pages-admin/editCategory.php';
        break;

        // Quản lý sản phẩm
    case 'Product':
        include '../admin/pages-admin/product.php';
        break;
    case 'editProduct':
        include '../admin/pages-admin/editProduct.php';
        break;
    case 'addProduct':
        include '../admin/pages-admin/addProduct.php';
        break;

        // Quản lý đơn hàng
    case 'Order':
        include "../admin/pages-admin/Order.php";
        break;
        // Quản lý bình luận
    case 'Comment':
        include "../admin/pages-admin/comment.php";
        break;
    case 'Reply':
        include "../admin/pages-admin/Reply.php";
        break;
    default:
        include '../admin/pages-admin/home.php';
        break;
}
?>

</div>
</div>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Template Javascript -->
<script src="../admin/js/main.js"></script>
</body>

</html>