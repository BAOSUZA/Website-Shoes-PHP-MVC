<?php
$idOrder = $_GET['idOrder'];
$Status = $_GET['Status'];
include '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/OAuthTokenProvider.php';
require '../PHPMailer/src/OAuth.php';
require '../PHPMailer/src/POP3.php';

$mail = new PHPMailer(true);


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
    $submess = "<br><br>";
    $total = 0;
    if ($Status == 1) {
        $query = "UPDATE `orders` SET `status` = 'Đang Vận chuyển' WHERE `id` = $idOrder";
        $queryMail = "SELECT * FROM product p, order_details od, user u WHERE p.id = od.product_id AND u.id = od.user_id AND od.order_id = $idOrder";
        $resultMail = mysqli_query($conn, $queryMail);
        $mess = "Đơn hàng đang được giao tới bạn.";
        while ($rowMail = mysqli_fetch_array($resultMail)) {
            $email = $rowMail['email'];
            $name = $rowMail['fullname'];
            $total += $rowMail['total_money'];
            $submess .= 'Tên sản phẩm: '.$rowMail['title'].'<br>
            Giá: '.number_format($rowMail['price'] - ceil($rowMail['price'] * $rowMail['discount'] / 100), 0, '.', '.').' VND<br>
            Số lượng: '.$rowMail['num'].'<br><br>'; 
        }
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'DABOTING';
        $mess .= $submess . "Tổng tiền: ".number_format($total, 0, '.', '.')." VND<br><br>Vui lòng chuẩn bị số tiền để nhận hàng";
    } else {
        $query = "UPDATE `orders` SET `status` = 'Đã giao hàng' WHERE `id` = $idOrder";
        $queryMail = "SELECT * FROM product p, order_details od, user u WHERE p.id = od.product_id AND u.id = od.user_id AND od.order_id = $idOrder";
        $resultMail = mysqli_query($conn, $queryMail);
        $mess = "Đơn hàng đã giao thanh công.";
        while ($rowMail = mysqli_fetch_array($resultMail)) {
            $email = $rowMail['email'];
            $name = $rowMail['fullname'];
            $total += $rowMail['total_money'];
            $submess .= 'Tên sản phẩm: '.$rowMail['title'].'<br>
            Giá: '.number_format($rowMail['price'] - ceil($rowMail['price'] * $rowMail['discount'] / 100), 0, '.', '.').' VND<br>
            Số lượng: '.$rowMail['num'].'<br><br>'; 
        }
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = 'DABOTING';
        $mess .= $submess . "Tổng tiền: ".number_format($total, 0, '.', '.')." VND<br><br>Cảm ơn bạn đã tin tưởng shop.";
    }
    mysqli_query($conn, $query);

    $mail->Body    = $mess;

    $mail->send();
    header("location: ../index.php?page=Order");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
