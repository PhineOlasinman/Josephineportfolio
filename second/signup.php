<?php
include 'db.php'; // your database connection

if (isset($_POST['signup'])) {
    // Get form data
    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['pass'] ?? '');

    if (!$fname || !$lname || !$email || !$pass) {
        echo "<script>alert('Please fill in all fields!'); window.location.href='index.php';</script>";
        exit;
    }

    // Hash the password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email exists
    $check_sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='index.php';</script>";
    } else {
        $insert_sql = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$hashed_pass')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Registration successful! You can now log in.'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>
