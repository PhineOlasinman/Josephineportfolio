<?php
session_start();
include (db.php); // keep your original DB connection

if (isset($_POST['login'])) {
    // Get and trim form input
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Check for empty fields
    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields!'); window.location.href='index.php';</script>";
        exit;
    }

    // Prepare and execute query securely
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['fname'] = $user['fname'];
            $_SESSION['lname'] = $user['lname'];
            $_SESSION['email'] = $user['email'];

            // Redirect to front page
            header("Location: front.html");
            exit;
        } else {
            echo "<script>alert('Incorrect password!'); window.location.href='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('No account found with this email!'); window.location.href='index.php';</script>";
        exit;
    }

    $stmt->close();
}

$conn->close();
?>
