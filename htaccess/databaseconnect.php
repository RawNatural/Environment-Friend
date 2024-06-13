<?php
$servername = "127.0.0.1:3306";
$database = "u575039812_portfolio_db";
$username = "u575039812_root";
$password = "8K~qbp=uj[";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";





?>
