<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = trim($_POST["fname"]);
  $lname = trim($_POST["lname"]);
  $email = trim($_POST["email"]);
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // Check if email already exists
  $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists! Please log in.'); window.location='signin.html';</script>";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $password);

    if ($stmt->execute()) {
      echo "<script>alert('Signup successful! You can now log in.'); window.location='signin.html';</script>";
    } else {
      echo "Error: " . $conn->error;
    }

    $stmt->close();
  }
  $check->close();
  $conn->close();
}
?>
