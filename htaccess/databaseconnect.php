<?php
$servername = "localhost";
$database = "environmentFriend";
$username = "nathan";
$password = "@Bron5a1";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";





?>
