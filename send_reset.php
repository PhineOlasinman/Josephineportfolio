<?php
include 'db.php'; // database connection

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = bin2hex(random_bytes(50)); // generate reset token

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        // Save token to database
        mysqli_query($conn, "UPDATE users SET reset_token='$token' WHERE email='$email'");

        // Create reset link
        $reset_link = "http://localhost/your_project/reset_password.php?token=$token";

        // Ideally send email here - for now we'll show it
        echo "A reset link has been generated:<br>";
        echo "<a href='$reset_link'>$reset_link</a>";
    } else {
        echo "<script>alert('Email not found!'); window.location='forgot_password.php';</script>";
    }
}
?>
