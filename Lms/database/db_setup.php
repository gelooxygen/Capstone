<?php
// Database Configuration
$host = 'localhost';
$username = 'root';  // Default XAMPP MySQL username
$password = '';      // Default XAMPP MySQL password
$dbname = 'lms_db';

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// SQL Queries for Table Creation
$sql_queries = [
    // Roles Table
    "CREATE TABLE IF NOT EXISTS roles (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) UNIQUE NOT NULL,
        description TEXT
    )",

    // Users Table
    "CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        role_id INT,
        profile_picture VARCHAR(255),
        date_of_birth DATE,
        phone_number VARCHAR(20),
        address TEXT,
        is_active BOOLEAN DEFAULT TRUE,
        last_login TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (role_id) REFERENCES roles(id)
    )",

    // Courses Table
    "CREATE TABLE IF NOT EXISTS courses (
        id INT PRIMARY KEY AUTO_INCREMENT,
        code VARCHAR(20) UNIQUE NOT NULL,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        instructor_id INT,
        department VARCHAR(100),
        credits DECIMAL(3,1),
        semester VARCHAR(20),
        year INT,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (instructor_id) REFERENCES users(id)
    )",

    // Enrollments Table
    "CREATE TABLE IF NOT EXISTS enrollments (
        id INT PRIMARY KEY AUTO_INCREMENT,
        student_id INT,
        course_id INT,
        enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM('Active', 'Completed', 'Dropped') DEFAULT 'Active',
        FOREIGN KEY (student_id) REFERENCES users(id),
        FOREIGN KEY (course_id) REFERENCES courses(id),
        UNIQUE KEY (student_id, course_id)
    )",

    // Assignments Table
    "CREATE TABLE IF NOT EXISTS assignments (
        id INT PRIMARY KEY AUTO_INCREMENT,
        course_id INT,
        title VARCHAR(100) NOT NULL,
        description TEXT,
        due_date DATETIME,
        max_score DECIMAL(5,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (course_id) REFERENCES courses(id)
    )",

    // Submissions Table
    "CREATE TABLE IF NOT EXISTS submissions (
        id INT PRIMARY KEY AUTO_INCREMENT,
        assignment_id INT,
        student_id INT,
        submission_file VARCHAR(255),
        submission_text TEXT,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        grade DECIMAL(5,2),
        feedback TEXT,
        FOREIGN KEY (assignment_id) REFERENCES assignments(id),
        FOREIGN KEY (student_id) REFERENCES users(id)
    )",

    // Events Table
    "CREATE TABLE IF NOT EXISTS events (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(100) NOT NULL,
        description TEXT,
        start_datetime DATETIME,
        end_datetime DATETIME,
        location VARCHAR(255),
        event_type ENUM('Academic', 'Extracurricular', 'Administrative') DEFAULT 'Academic',
        created_by INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (created_by) REFERENCES users(id)
    )",

    // Notifications Table
    "CREATE TABLE IF NOT EXISTS notifications (
        id INT PRIMARY KEY AUTO_INCREMENT,
        user_id INT,
        message TEXT NOT NULL,
        is_read BOOLEAN DEFAULT FALSE,
        type ENUM('System', 'Course', 'Assignment', 'Event') DEFAULT 'System',
        related_id INT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )",

    // Insert Roles
    "INSERT IGNORE INTO roles (name, description) VALUES 
    ('Admin', 'System Administrator'),
    ('Teacher', 'Course Instructor'),
    ('Student', 'Learning Participant'),
    ('Parent', 'Student Guardian')",

    // Insert Default Admin Account
    "INSERT IGNORE INTO users (username, email, password, first_name, last_name, role_id, is_active) VALUES 
    ('admin', 'admin@scholaangelusagape.edu', 
    '$2y$10$8FPr7LwB0FYFVVg6x2h0QuezYW.YHwTXnw.eoRgQhbfjX1HUVGp3y', 
    'System', 'Administrator', 
    (SELECT id FROM roles WHERE name = 'Admin'), TRUE)",

    // Sample Course
    "INSERT IGNORE INTO courses (code, name, description, instructor_id, department, credits, semester, year) VALUES
    ('CS101', 'Introduction to Computer Science', 'Foundational course in computer science', 
    (SELECT id FROM users WHERE username = 'admin'), 'Computer Science', 3.0, 'Fall', 2025)"
];

// Execute Table Creation Queries
foreach ($sql_queries as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Query executed successfully: " . substr($query, 0, 50) . "...<br>";
    } else {
        echo "Error executing query: " . $conn->error . "<br>";
    }
}

// Close connection
$conn->close();

echo "Database setup completed successfully!";
?>