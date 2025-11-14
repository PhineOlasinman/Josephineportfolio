<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="design/signup.css">
  <title>Sign Up</title>
</head>
<body>
  <div class="login-container">
    <h1>Create Account</h1>
    <!-- Form points to process_signup.php inside security folder -->
    <form action="process_signup.php" method="POST">
      
      <label>First Name</label>
      <input type="text" name="first_name" required>

      <label>Last Name</label>
      <input type="text" name="last_name" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Sign Up</button>

      <!-- Link to login page inside security folder -->
      <a href="login.php" class="back-link">Already have an account? Login</a>
    </form>
  </div>
</body>
</html>
