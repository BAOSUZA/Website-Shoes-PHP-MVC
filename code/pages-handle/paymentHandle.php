<?php
session_start();
include '../database/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/OAuthTokenProvider.php';
require '../PHPMailer/src/OAuth.php';
require '../PHPMailer/src/POP3.php';

$mail = new PHPMailer(true);

if (!empty($_SESSION)) {
    $idUser = $_SESSION['IDUser'];
}

if (!empty($_POST)) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $total = $_POST['total'];
    $idOrderDetailSend = $_POST['idOrderDetailSend'];
}

try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pquochuy25102003@gmail.com';
    $mail->Password   = 'rxucsssxfwksvawu';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('pquochuy25102003@gmail.com', 'DABOTING');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'DABOTING';


    if (!empty($_POST['idProductSend'])) {
        echo 1;
        $idProductReceive = $_POST['idProductSend'];
        $priceProductReceive = $_POST['priceProductSend'];
        $price = $priceProductReceive;
        // thêm vào giỏ hàng
        $queryOrder_Detail = "INSERT INTO `order_details` (`user_id` , `product_id`, `price`, `num`, `total_money`) 
        VALUES ('$idUser', '$idProductReceive', '$price', '1', `price` * `num`)";
        mysqli_query($conn, $queryOrder_Detail);
        $idod = $conn->insert_id;
        //thêm vào đơn hàng
        $queryPaymentOrder =
            "INSERT INTO `orders` (`user_id`, `fullname`, `email`, `phone_number`, `address`, `order_date`, `status`, `total_money`) 
        VALUES ('$idUser', '$name', '$email', '$phone', '$address', CURRENT_TIMESTAMP(), 'Đang xử lý', '$total')";
        mysqli_query($conn, $queryPaymentOrder);
        $ido = $conn->insert_id;
        $queryUpdateOrderDetail = "UPDATE order_details SET order_id = $ido WHERE id = $idod AND user_id = $idUser";
        mysqli_query($conn, $queryUpdateOrderDetail);
        // cập nhật số lượng sản phẩm
        mysqli_query($conn, "UPDATE product SET quantity_purchased = quantity_purchased + 1 WHERE id = $idProductReceive");
        mysqli_query($conn, "UPDATE product SET quantity = quantity - 1  WHERE id = $idProductReceive");
        // duyệt sản phẩm vừa thêm để gửi về mail
        $queryMail = "SELECT * FROM product p, order_details od WHERE p.id = od.product_id AND p.id = $idProductReceive AND od.id = $idod AND od.user_id = $idUser";
        $resultMail = mysqli_query($conn, $queryMail);
        $rowMail = mysqli_fetch_array($resultMail);
        $nameProduct = $rowMail['title'];
        $qtyProduct = $rowMail['num'];
        $totalProduct = $rowMail['total_money'];
        $mess = 'Bạn đã đặt đơn hàng thành công!!<br>
                Chi tiết đơn hàng:<br>
                Tên sản phẩm: ' . $nameProduct . '<br>
                Giá: ' . number_format($price, 0, '.', '.') . 'VND<br>
                Số lượng: ' . $qtyProduct . '<br>
                Tổng tiền: ' . number_format($totalProduct, 0, '.', '.') . 'VND<br>
                Cảm ơn bạn đã tin tưởng và ủng hộ chúng tôi!!';
    } else {
        echo 2;
        $queryPaymentOrder =
            "INSERT INTO `orders` (`user_id`, `fullname`, `email`, `phone_number`, `address`, `order_date`, `status`, `total_money`) 
        VALUES ('$idUser', '$name', '$email', '$phone', '$address', CURRENT_TIMESTAMP(), 'Đang xử lý', '$total')";
        mysqli_query($conn, $queryPaymentOrder);
        $id = $conn->insert_id;
        $listIDOD = explode(" ", $idOrderDetailSend);
        $condition = "";
        foreach ($listIDOD as $key => $value) {
            if ($key < (count($listIDOD) - 2)) {
                $condition .= "id = $value OR  ";
            }
        }
        $condition .= $condition  . " id = " . $listIDOD[count($listIDOD) - 2] . " AND user_id = $idUser";
        $queryUpdateOrderDetail = "UPDATE order_details SET order_id = $id WHERE $condition";
        mysqli_query($conn, $queryUpdateOrderDetail);
        // cập nhật số lượng sản phẩm
        $quantity_purchased = 0;
        foreach ($listIDOD as $key => $value) {
            if ($key < count($listIDOD) - 1) {
                $querydisplay = "SELECT * FROM order_details WHERE id = $value";
                $resultdisplay = mysqli_query($conn, $querydisplay);
                $rowdisplay = mysqli_fetch_array($resultdisplay);
                $quantity_purchased = $rowdisplay['num'];
                mysqli_query($conn, "UPDATE product SET quantity_purchased = quantity_purchased + $quantity_purchased WHERE id = " . $rowdisplay['product_id'] . "");
                mysqli_query($conn, "UPDATE product SET quantity = quantity - $quantity_purchased WHERE id = " . $rowdisplay['product_id'] . "");
            }
        }
        $queryMail = "SELECT * FROM product p, order_details od, user u WHERE p.id = od.product_id AND u.id = od.user_id AND od.order_id = $id AND od.user_id = $idUser";
        $resultMail = mysqli_query($conn, $queryMail);
        $mess = "Bạn đã đặt đơn hàng thành công.";
        $submess = "";
        $total = 0;
        while ($rowMail = mysqli_fetch_array($resultMail)) {
            $email = $rowMail['email'];
            $name = $rowMail['fullname'];
            $total += $rowMail['total_money'];
            $submess .= '<br><br>Tên sản phẩm: ' . $rowMail['title'] . '<br>
            Giá: ' . number_format($rowMail['price'] - ceil($rowMail['price'] * $rowMail['discount'] / 100), 0, '.', '.') . ' VND<br>
            Số lượng: ' . $rowMail['num'] . '<br><br>';
        }
        $mess .= $submess . "Tổng tiền: ".number_format($total, 0, '.', '.')." VND<br><br>Cảm ơn bạn đã tin tưởng và ủng hộ chúng tôi!!";
    }

    $mail->Body    = $mess;

    $mail->send();
    header("location: ../user/index.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
