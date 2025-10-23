<?php
include 'db.php'; // Database connection

if (isset($_POST['signup'])) {
    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['pass'] ?? '');
    $confirm = trim($_POST['confirm'] ?? '');

    // Check empty fields
    if (!$fname || !$lname || !$email || !$pass || !$confirm) {
        echo "<script>alert('Please fill in all fields!'); window.location.href='index.php';</script>";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!'); window.location.href='index.php';</script>";
        exit;
    }

    // Check password match
    if ($pass !== $confirm) {
        echo "<script>alert('Passwords do not match!'); window.location.href='index.php';</script>";
        exit;
    }

    // Hash password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='index.php';</script>";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Insert new user
    $insert_stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pass);

    if ($insert_stmt->execute()) {
        echo "<script>alert('Registration successful! You can now log in.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: ".$conn->error."'); window.location.href='index.php';</script>";
    }

    $insert_stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit;
}
?>
