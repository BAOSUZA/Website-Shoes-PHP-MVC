<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    include ("../config.php");
    $query = "INSERT INTO category (`name`) VALUES ('$name');";
    mysqli_query($conn, $query);
    header("location: ../index.php?page=Category");
}
