<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"];
$pass = $data["pass"];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
  echo json_encode(["success" => false, "message" => "Account does not exist!"]);
  exit();
}

$user = $result->fetch_assoc();

if (!password_verify($pass, $user["pass"])) {
  echo json_encode(["success" => false, "message" => "Incorrect password!"]);
  exit();
}

// successful login
echo json_encode(["success" => true, "message" => "Login successful!"]);
$conn->close();
?>