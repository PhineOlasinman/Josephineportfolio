<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="design/login.css">
  <title>Login</title>
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <form action="security/process_login.php" method="POST">
      <label>Email</label>
      <input type="email" name="email" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>

      <!-- Links Row -->
      <div class="links-row">
        <a href="security/signup.php" class="account-link">Don't have an account? Create an account</a>
        
      </div>
    </form>
  </div>
</body>
</html>
