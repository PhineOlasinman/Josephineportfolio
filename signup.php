<?php
header("Content-Type: application/json");
include 'db.php'; // Database connection

// Decode incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Extract data safely
$fname = $data["fname"] ?? "";
$lname = $data["lname"] ?? "";
$email = $data["email"] ?? "";
$pass = $data["pass"] ?? "";

// Validate required fields
if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
  echo json_encode(["success" => false, "message" => "All fields are required!"]);
  exit();
}

// ✅ Check if email already exists
$check = $conn->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
  echo json_encode(["success" => false, "message" => "Account already exists!"]);
  $check->close();
  $conn->close();
  exit();
}

// ✅ Hash password before storing
$hashed = password_hash($pass, PASSWORD_DEFAULT);

// ✅ Insert new user
$stmt = $conn->prepare("INSERT INTO users (fname, lname, email, pass) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fname, $lname, $email, $hashed);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Account created successfully!"]);
} else {
  echo json_encode(["success" => false, "message" => "Error creating account: " . $conn->error]);
}

$stmt->close();
$conn->close();
?>
