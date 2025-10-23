<?php
include 'db.php'; // your database connection

if (isset($_POST['signup'])) {
    // Get form data
    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['pass'] ?? '');

    // Check for empty fields
    if (empty($fname) || empty($lname) || empty($email) || empty($pass)) {
        echo "<script>alert('Please fill in all fields!'); window.location.href='index.php';</script>";
        exit;
    }

    // Hash the password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email exists using prepared statement
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result(); // needed to check num_rows

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='index.php';</script>";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Insert new user securely
    $insert_stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pass);

    if ($insert_stmt->execute()) {
        echo "<script>alert('Registration successful! You can now log in.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='index.php';</script>";
    }

    $insert_stmt->close();
    $conn->close();
}
?>
