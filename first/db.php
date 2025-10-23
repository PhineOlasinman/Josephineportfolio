<?php
$host = "localhost";
$dbname = "josephine";
$username = "root"; // default XAMPP username
$password = "";     // default XAMPP password

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
