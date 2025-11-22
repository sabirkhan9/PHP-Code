<?php
$host = "localhost";
$user = "root";       // your mysql username
$pass = "";           // your mysql password
$db   = "sabir";      // your DB name

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
