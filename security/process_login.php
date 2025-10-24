<?php
session_start();
 include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $conn->query("SELECT * FROM user WHERE email = '$email'");
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['first_name'];
            header("Location: front.html");
            exit;
        }
    }
    echo "<script>alert('Invalid login credentials'); window.location='login.php';</script>";
}
?>
