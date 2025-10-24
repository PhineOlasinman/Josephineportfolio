<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<nav class="navbar">
  <ul>
    <li><a href="index.php" class="nav-link">HOME</a></li>
    <li><a href="add.html" class="nav-link">PROJECT</a></li>
    <li><a href="#about" class="nav-link">ABOUT</a></li>
    <li><a href="login.php" id="loginBtn">LOGOUT</a></li>
    
   
  </ul>
</nav>
