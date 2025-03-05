<?php
session_start();
require_once '../../config/database.php';

// Function to validate admin credentials
function validateAdmin($username, $password) {
    global $conn;
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM admin_users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        // Verify password hash
        if (password_verify($password, $admin['password'])) {
            return $admin;
        }
    }
    return false;
}

// Handle login request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../admin-login.php");
        exit();
    }
    
    $admin = validateAdmin($username, $password);
    
    if ($admin) {
        // Start secure session
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['is_admin'] = true;
        $_SESSION['last_activity'] = time();
        
        header("Location: ../dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../admin-login.php");
        exit();
    }
}
?>
