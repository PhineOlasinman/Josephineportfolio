<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM user WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already exists!'); window.location='signup.php';</script>";
    } else {
        $query = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first', '$last', '$email', '$password')";
        if ($conn->query($query)) {
            echo "<script>alert('Account created! Please login.'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error creating account.'); window.location='signup.php';</script>";
        }
    }
}
?>
