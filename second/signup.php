<?php
include 'db.php'; // your database connection

// Get the raw POST data (JSON)
$input = json_decode(file_get_contents('php://input'), true);

// Initialize response
$response = ["success" => false, "message" => ""];

if ($input) {
    $fname = trim($input['fname'] ?? '');
    $lname = trim($input['lname'] ?? '');
    $email = trim($input['email'] ?? '');
    $pass = trim($input['pass'] ?? '');

    // Check for empty fields
    if (!$fname || !$lname || !$email || !$pass) {
        $response['message'] = "Please fill in all fields!";
        echo json_encode($response);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Invalid email format!";
        echo json_encode($response);
        exit;
    }

    // Hash password
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $response['message'] = "Email already registered!";
        echo json_encode($response);
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();

    // Insert new user
    $insert_stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $insert_stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pass);

    if ($insert_stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Registration successful! You can now log in.";
    } else {
        $response['message'] = "Error: " . $conn->error;
    }

    $insert_stmt->close();
    $conn->close();
} else {
    $response['message'] = "Invalid request!";
}

echo json_encode($response);
