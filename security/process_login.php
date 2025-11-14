<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form values safely
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {

            // Store user's first name in session
            $_SESSION['user'] = $row['first_name'];

            // Redirect to intro page
            header("Location: ../intro/index.php");
            exit;
        }
    }

    // If login fails
    echo "<script>alert('Invalid login credentials'); window.location='../login.php';</script>";
}
?>
