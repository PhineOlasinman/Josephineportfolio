<?php
session_start();
include 'db.php';

// ✅ Function to handle login
function loginUser($conn, $email, $password) {
    $response = ["success" => false, "message" => ""];

    if (!$email || !$password) {
        $response["message"] = "Please fill in all fields.";
        return $response;
    }

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

            $response["success"] = true;
            $response["message"] = "Welcome, " . $user["fname"] . "!";
        } else {
            $response["message"] = "Invalid password!";
        }
    } else {
        $response["message"] = "No account found with this email!";
    }

    $stmt->close();
    return $response;
}

$data = json_decode(file_get_contents("php://input"), true);
$email = trim($data["email"] ?? '');
$password = trim($data["password"] ?? '');

$response = loginUser($conn, $email, $password);
$conn->close();

echo json_encode($response);
?>
