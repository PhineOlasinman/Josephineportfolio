<?php
// Include the database connection
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if all required fields are set
    if (!isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
        echo "<script>alert('Please fill in all required fields.'); window.location='signup.php';</script>";
        exit;
    }

    // Trim and get form inputs
    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($first) || empty($last) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required.'); window.location='signup.php';</script>";
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare statement to check if email already exists
    $check = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Email already exists!'); window.location='signup.php';</script>";
        exit;
    }

    // Prepare statement to insert new user
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first, $last, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Success
        echo "<script>alert('Account created! Please login.'); window.location='login.php';</script>";
    } else {
        // Error
        echo "<script>alert('Error creating account.'); window.location='signup.php';</script>";
    }

    // Close statements and connection
    $stmt->close();
    $check->close();
    $conn->close();
}
?>
