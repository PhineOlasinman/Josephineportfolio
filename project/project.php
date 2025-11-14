<?php
$servername = "db.fr-pari1.bengt.wasmernet.com";
$username = "6927c6aa7eb68000a345b064e38f"; // your MySQL username
$password = "06916927-c6ab-704b-8000-964b5e5f3eb5";     // your MySQL password
$database = "josephine";
$port = "10272";

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
