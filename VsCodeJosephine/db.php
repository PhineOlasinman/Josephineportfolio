<?php
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default empty password
$dbname = "portfolio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}
?>
