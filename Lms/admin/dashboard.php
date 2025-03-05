<?php
session_start();
require_once '../config/database.php';

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

// Get admin info
$admin_id = $_SESSION['admin_id'];
$stmt = $conn->prepare("SELECT full_name, email, last_login FROM admin_users WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin_info = $result ? $result->fetch_assoc() : null;

// Initialize stats
$stats = [
    'students' => 0,
    'teachers' => 0,
    'courses' => 0
];

// Check if tables exist before querying
$tables = ['students', 'teachers', 'courses'];
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows > 0) {
        $count_result = $conn->query("SELECT COUNT(*) as count FROM $table");
        if ($count_result) {
            $stats[$table] = $count_result->fetch_assoc()['count'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Schola Angelus Agape</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/admin-dashboard.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header">
                <h3>Admin Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#studentsSubmenu" data-bs-toggle="collapse">
                        <i class="fas fa-user-graduate"></i> Students
                    </a>
                    <ul class="collapse list-unstyled" id="studentsSubmenu">
                        <li><a href="#">View All Students</a></li>
                        <li><a href="#">Add New Student</a></li>
                        <li><a href="#">Manage Students</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#teachersSubmenu" data-bs-toggle="collapse">
                        <i class="fas fa-chalkboard-teacher"></i> Teachers
                    </a>
                    <ul class="collapse list-unstyled" id="teachersSubmenu">
                        <li><a href="#">View All Teachers</a></li>
                        <li><a href="#">Add New Teacher</a></li>
                        <li><a href="#">Manage Teachers</a></li>
                    </ul>
                </li>
                <li>
                        <a href="#coursesSubmenu" data-bs-toggle="collapse">
                            <i class="fas fa-book"></i> Courses
                        </a>
                        <ul class="collapse list-unstyled" id="coursesSubmenu">
                        <li><a href="view-course.php">View All Courses</a></li>
                        <li><a href="add-course.php">Add New Course</a></li>
                        <li><a href="manage-courses.php">Manage Courses</a></li>
                        </ul>
                    </li>
                <li>
                    <a href="auth/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ms-2">
                        <span class="text-white">Welcome, <?php echo htmlspecialchars($admin_info['full_name'] ?? $_SESSION['admin_username']); ?></span>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Students</h5>
                                <p class="card-text display-4"><?php echo $stats['students']; ?></p>
                                <i class="fas fa-user-graduate fa-3x position-absolute end-0 bottom-0 mb-3 me-3 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Teachers</h5>
                                <p class="card-text display-4"><?php echo $stats['teachers']; ?></p>
                                <i class="fas fa-chalkboard-teacher fa-3x position-absolute end-0 bottom-0 mb-3 me-3 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title">Total Courses</h5>
                                <p class="card-text display-4"><?php echo $stats['courses']; ?></p>
                                <i class="fas fa-book fa-3x position-absolute end-0 bottom-0 mb-3 me-3 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Recent Activities</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">No recent activities to display.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="add-course.php" class="btn btn-info text-white">
                                        <i class="fas fa-plus-circle"></i> Create New Course
                                    </a>
                                    <a href="teachers/add-teacher.php" class="btn btn-success">
                                        <i class="fas fa-plus-circle"></i> Add New Teacher
                                    </a>
                                    <a href="courses/add-course.php" class="btn btn-info text-white">
                                        <i class="fas fa-plus-circle"></i> Create New Course
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>