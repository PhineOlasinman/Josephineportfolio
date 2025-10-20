<?php
session_start();
session_unset();
session_destroy();

echo "<script>
  localStorage.setItem('isLoggedIn', 'false');
  alert('You have successfully logged out.');
  window.location='signin.html';
</script>";
?>
