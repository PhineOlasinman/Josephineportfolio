<?php
// Include the database connection (adjust path as needed)
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Trim and get form inputs
    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Prepare statement to check if email already exists
    $check = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
        // Email already exists, alert and redirect to signup page
        echo "<script>alert('Email already exists!'); window.location='../signup.php';</script>";
        exit;
    }

    // Prepare statement to insert new user safely
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first, $last, $email, $password);

    if ($stmt->execute()) {
        // Success: alert and redirect to login page
        echo "<script>alert('Account created! Please login.'); window.location='../login.php';</script>";
        exit;
    } else {
        // Error: alert and redirect back to signup
        echo "<script>alert('Error creating account.'); window.location='../signup.php';</script>";
        exit;
    }
}
?>
