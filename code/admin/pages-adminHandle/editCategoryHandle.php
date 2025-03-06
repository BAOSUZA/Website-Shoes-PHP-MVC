<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $id = $_GET['id'];
    include ("../config.php");
    $query = "UPDATE category SET  name  = '$name' where id = $id";
    mysqli_query($conn, $query);
    header("location: ../index.php?page=Category");
}
