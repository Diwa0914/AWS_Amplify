<?php
// Localhost connection for XAMPP
$host = "localhost";
$username = "root";
$password = "";
$database = "voting";

$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
