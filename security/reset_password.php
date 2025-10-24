<?php
session_start();
include 'db.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];

    // Check if token is valid and not expired
    $stmt = $conn->prepare("SELECT * FROM user_form WHERE reset_token=? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
        die("Invalid or expired token.");
    }
} else {
    die("No token provided.");
}

// Handle form submission
if(isset($_POST['reset'])){
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE user_form SET password=?, reset_token=NULL, token_expiry=NULL WHERE reset_token=?");
    $stmt->bind_param("ss", $password, $token);
    $stmt->execute();

    $_SESSION['message'] = "Password updated successfully.";
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>
</head>
<body>
<h2>Reset Password</h2>
<form method="POST">
    <label>New Password:</label>
    <input type="password" name="password" required>
    <button type="submit" name="reset">Reset Password</button>
</form>
</body>
</html>
