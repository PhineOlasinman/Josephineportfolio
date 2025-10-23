<?php
if (!isset($_GET['token'])) {
    die("Invalid token!");
}
$token = $_GET['token'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <form action="update_password.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <label>New Password:</label><br>
        <input type="password" name="new_pass" required><br><br>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
