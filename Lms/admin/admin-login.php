<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/database.php';

// Check if already logged in
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: dashboard.php");
    exit();
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Debug info
        error_log("Login attempt - Username: " . $username);
        
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, username, password FROM admin_users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        error_log("Query executed - Found rows: " . $result->num_rows);
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            error_log("Stored password hash: " . $admin['password']);
            error_log("Attempting to verify password...");
            
            // Verify password
            if (password_verify($password, $admin['password'])) {
                error_log("Password verified successfully!");
                
                // Start secure session
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['is_admin'] = true;
                $_SESSION['last_activity'] = time();
                
                // Update last login
                $update = $conn->prepare("UPDATE admin_users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
                $update->bind_param("i", $admin['id']);
                $update->execute();
                
                header("Location: dashboard.php");
                exit();
            } else {
                error_log("Password verification failed!");
                $error = "Invalid username or password.";
            }
        } else {
            error_log("No admin user found with username: " . $username);
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Schola Angelus Agape</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/login.css">
</head>
<body class="admin-theme">
    <div class="container">
        <div class="login-container">
            <div class="login-header text-center">
                <img src="../images/logo.jpg" alt="School Logo" class="logo">
                <h2>Admin Login</h2>
                <p>Secure Administrative Access</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <form class="login-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                </div>
                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Password" required>
                    </div>
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Secure Login
                </button>
            </form>
            <div class="mt-4 text-center">
                    <a href="../index.php" class="btn btn-link"><i class="fas fa-arrow-left"></i> Back to Homepage</a>
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Clear password field on page load for security
        window.onload = function() {
            document.getElementById('password').value = '';
        }
    </script>
</body>
</html>
