<?php
session_start();
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$fname = trim($data["fname"] ?? '');
$lname = trim($data["lname"] ?? '');
$email = trim($data["email"] ?? '');
$pass = trim($data["pass"] ?? '');
$response = ["success" => false, "message" => ""];

if (!$fname || !$lname || !$email || !$pass) {
  $response["message"] = "Please fill in all fields.";
  echo json_encode($response);
  exit;
}

$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pass);

if ($stmt->execute()) {
  $response["success"] = true;
  $response["message"] = "Account created successfully!";
} else {
  $response["message"] = "Email already exists!";
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
