<?php
include 'db.php';

if (isset($_POST['signup'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (!$first_name || !$last_name || !$email || !$password || !$confirm_password) {
        echo "<script>alert('Please fill in all fields'); window.location='index.php';</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match'); window.location='index.php';</script>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email already registered'); window.location='index.php';</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Signup successful, please login'); window.location='index.php';</script>";
            } else {
                echo "<script>alert('Signup failed'); window.location='index.php';</script>";
            }
        }
    }
}
?>
