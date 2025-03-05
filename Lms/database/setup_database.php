<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Create connection
    $conn = new mysqli($host, $user, $pass);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Read and execute SQL file
    $sql = file_get_contents('lms_db.sql');
    
    if ($conn->multi_query($sql)) {
        do {
            // Store first result set
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());
        
        echo "Database setup completed successfully!<br>";
        echo "Default admin credentials:<br>";
        echo "Username: admin<br>";
        echo "Password: Admin@123<br>";
        echo "<br>Please change these credentials after your first login.";
    } else {
        echo "Error executing SQL: " . $conn->error;
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
