<?php
function checkAdminSession() {
    // Check if user is logged in
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
        header("Location: admin-login.php");
        exit();
    }
    
    // Check session timeout (30 minutes)
    $timeout = 1800; // 30 minutes in seconds
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        header("Location: admin-login.php?error=timeout");
        exit();
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
}
?>
