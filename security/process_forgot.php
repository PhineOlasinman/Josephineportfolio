<?php
session_start();
include 'db.php'; // your database connection

if(isset($_POST['forgot'])){
    $email = trim($_POST['email']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $token = bin2hex(random_bytes(50)); // generate a unique token
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // token expires in 1 hour

        // Save token in database
        $stmt = $conn->prepare("UPDATE `user` SET reset_token = ?, token_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        // Create reset link
        $reset_link = "http://yourdomain.com/reset_password.php?token=$token";

        // Send email
        $subject = "Password Reset Request";
        $message = "Click this link to reset your password: $reset_link";
        $headers = "From: no-reply@yourdomain.com";

        if(mail($email, $subject, $message, $headers)){
            $_SESSION['message'] = "Password reset link sent to your email.";
        } else {
            $_SESSION['message'] = "Failed to send email.";
        }
    } else {
        $_SESSION['message'] = "Email not found.";
    }
    header("Location: forgot_password.php");
}
