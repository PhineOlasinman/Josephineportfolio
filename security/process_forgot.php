<?php
session_start();
include 'db.php'; // your database connection

if(isset($_POST['forgot'])){
    $email = trim($_POST['email']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // Generate a temporary password
        $temp_password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);
        $hashed_password = password_hash($temp_password, PASSWORD_DEFAULT);

        // Update the user password in the database
        $stmt = $conn->prepare("UPDATE `user` SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashed_password, $email);
        $stmt->execute();

        // Send the temporary password via email
        $subject = "Your Temporary Password";
        $message = "Your temporary password is: $temp_password\nPlease log in and change it immediately.";
        $headers = "From: no-reply@yourdomain.com";

        if(mail($email, $subject, $message, $headers)){
            $_SESSION['message'] = "Temporary password sent to your email.";
        } else {
            $_SESSION['message'] = "Failed to send email.";
        }
    } else {
        $_SESSION['message'] = "Email not found.";
    }

    header("Location: forgot_password.php");
}
