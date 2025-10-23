<?php
session_start();
include 'db.php'; // keep your original DB connection

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);   // Adjust according to your form field name
    $password = trim($_POST['password']);



    if (!empty($email) && !empty($password)) {
        // Secure query using prepared statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Store session variables
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['fname'] = $user['fname'];
                $_SESSION['lname'] = $user['lname'];
                $_SESSION['email'] = $user['email'];

                // Redirect after success
                header("Location: front.html");
                exit();
            } else {
                echo "<script>alert('Incorrect password!'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('No account found with this email!'); window.location.href='index.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all fields!'); window.location.href='index.php';</script>";
    }
}

$conn->close();
?>