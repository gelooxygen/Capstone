<?php
session_start();
require_once '../config/database.php';

// Check if user is logged in as admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: auth/admin-login.php");
    exit();
}

// Handle form submission
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = $_POST['course_name'] ?? '';
    $course_code = $_POST['course_code'] ?? '';
    $description = $_POST['description'] ?? '';
    $department = $_POST['department'] ?? '';
    $credits = $_POST['credits'] ?? 0;
    $instructor_id = $_POST['instructor_id'] ?? null;

    // Validate inputs
    if (empty($course_name) || empty($course_code)) {
        $error_message = "Course Name and Course Code are required.";
    } else {
        // Prepare SQL to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO courses (course_name, course_code, description, department, credits, instructor_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssii", $course_name, $course_code, $description, $department, $credits, $instructor_id);

        if ($stmt->execute()) {
            $success_message = "Course added successfully!";
            // Clear form after successful submission
            $course_name = $course_code = $description = $department = $credits = $instructor_id = '';
        } else {
            $error_message = "Error adding course: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch list of teachers for instructor dropdown
$teachers_query = "SELECT id, full_name FROM teachers";
$teachers_result = $conn->query($teachers_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course - Schola Angelus Agape</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../style/admin-dashboard.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Add New Course</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlspecialchars($course_name ?? ''); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="course_code" class="form-label">Course Code</label>
                                <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo htmlspecialchars($course_code ?? ''); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <select class="form-select" id="department" name="department">
                                    <option value="">Select Department</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Literature">Literature</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="credits" class="form-label">Credits</label>
                                <input type="number" class="form-control" id="credits" name="credits" value="<?php echo htmlspecialchars($credits ?? ''); ?>" min="1" max="6">
                            </div>
                            <div class="mb-3">
                                <label for="instructor_id" class="form-label">Instructor</label>
                                <select class="form-select" id="instructor_id" name="instructor_id">
                                    <option value="">Select Instructor</option>
                                    <?php while ($teacher = $teachers_result->fetch_assoc()): ?>
                                        <option value="<?php echo $teacher['id']; ?>"><?php echo htmlspecialchars($teacher['full_name']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Course</button>
                            <a href="dashboard.php" class="btn btn-secondary ms-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>