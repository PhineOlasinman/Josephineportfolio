<?php
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default empty
<<<<<<< HEAD
$dbname = "portfolio";
=======
$dbname = "login_system";
>>>>>>> b23ec35a27adaca280403aff7e7d20e343e7a9c8

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
<<<<<<< HEAD
?>
=======
?>
>>>>>>> b23ec35a27adaca280403aff7e7d20e343e7a9c8
