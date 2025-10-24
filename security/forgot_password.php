<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Forgot Password</h2>
<form action="process_forgot.php" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <button type="submit" name="forgot">Submit</button>
</form>
<?php
if(isset($_SESSION['message'])){
    echo "<p>".$_SESSION['message']."</p>";
    unset($_SESSION['message']);
}
?>
</body>
</html>
