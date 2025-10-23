<?php
session_start();
include 'db.php'; // Make sure db.php contains your database connection

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!$email || !$password) {
        echo "<script>alert('Please fill in all fields'); window.location='index.php';</script>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                echo "<script>alert('Login successful'); window.location='dashboard.php';</script>";
            } else {
                echo "<script>alert('Incorrect password'); window.location='index.php';</script>";
            }
        } else {
            echo "<script>alert('No account found with this email'); window.location='index.php';</script>";
        }
    }
}
?>