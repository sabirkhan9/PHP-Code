<?php 
include("sk_connection.php");

$query = "SELECT * FROM meta_data";
$data = mysqli_query($conn, $query);
$rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
?>
