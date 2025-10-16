<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$fname = $data["fname"];
$lname = $data["lname"];
$email = $data["email"];
$pass = $data["pass"];

// check if account already exists
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo json_encode(["success" => false, "message" => "Account already exists!"]);
  exit();
}

// hash password before saving
$hashed = password_hash($pass, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (fname, lname, email, pass) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $fname, $lname, $email, $hashed);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Account created successfully!"]);
} else {
  echo json_encode(["success" => false, "message" => "Error saving user!"]);
}

$stmt->close();
$conn->close();
?>