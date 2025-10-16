<?php
header("Content-Type: application/json");
include 'db.php'; // connect to database

// Get JSON data from fetch()
$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"] ?? "";
$pass = $data["pass"] ?? "";

// Prevent empty fields
if (empty($email) || empty($pass)) {
  echo json_encode(["success" => false, "message" => "Email and password are required!"]);
  exit();
}

// Prepare SQL to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if account exists
if ($result->num_rows === 0) {
  echo json_encode(["success" => false, "message" => "Account does not exist!"]);
  exit();
}

// Verify password
$user = $result->fetch_assoc();
if (!password_verify($pass, $user["pass"])) {
  echo json_encode(["success" => false, "message" => "Incorrect password!"]);
  exit();
}

// If correct credentials
echo json_encode(["success" => true, "message" => "Login successful!"]);

$conn->close();
?>
