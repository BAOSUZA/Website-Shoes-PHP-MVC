<?php
    $servernameConn = "localhost:3333";
    $usernameConn = "root";
    $passwordConn = "";
    $dbnameConn = "doancoso2";
    $conn = mysqli_connect($servernameConn, $usernameConn, $passwordConn, $dbnameConn);
    mysqli_set_charset($conn, 'utf8');
?>