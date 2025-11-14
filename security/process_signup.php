<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $first = trim($_POST['first_name']);
    $last = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // CHECK IF EMAIL ALREADY EXISTS
    $check = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email already exists!'); window.location='signup.php';</script>";
        exit;
    }

    // INSERT USER SAFELY
    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first, $last, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Account created! Please login.'); window.location='login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error creating account.'); window.location='signup.php';</script>";
        exit;
    }
}
?>
