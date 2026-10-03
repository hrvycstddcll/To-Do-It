<?php 

$hostname = "localhost";
$username = "root"; 
$password = "";
$database = "to_do_itdb";

mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>