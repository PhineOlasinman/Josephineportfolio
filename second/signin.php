<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user["password"])) {
      $_SESSION["isLoggedIn"] = true;
      $_SESSION["fname"] = $user["fname"];
      $_SESSION["lname"] = $user["lname"];
      $_SESSION["email"] = $user["email"];

      echo "<script>
              localStorage.setItem('isLoggedIn', 'true');
              alert('Welcome, " . $user["fname"] . "!');
              window.location='front.html';
            </script>";
    } else {
      echo "<script>alert('Invalid password!'); window.location='signin.html';</script>";
    }
  } else {
    echo "<script>alert('No account found with this email!'); window.location='signin.html';</script>";
  }

  $stmt->close();
  $conn->close();
}
?>
