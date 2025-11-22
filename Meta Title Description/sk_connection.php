<?php
$host = "localhost";
$username = "metro245intl9_metroseo2023";
$password = "m1f).@)34yX64QH@";
$dbname = "metro245intl9_metroseo2023";

// Correct order: host, username, password, dbname
$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error){
    die("Database Connection failed: " . $conn->connect_error);
} 
?>
