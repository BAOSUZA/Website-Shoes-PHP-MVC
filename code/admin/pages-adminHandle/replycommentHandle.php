<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $replyComment = $_POST['replyComment'];
    include ("../config.php");
    $query = "UPDATE feedback SET content_reply = '$replyComment' where id = $id ";
    mysqli_query($conn, $query);
    header("location: ../index.php?page=Comment");
}
