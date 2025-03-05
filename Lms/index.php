<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Schola Angelus Agape - Learning Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="icon" type="image/png" href="images/logo.jpg">
    <meta property="og:image" content="images/logo.jpg">
    <link rel="stylesheet" href="style/index.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <div class="container-fluid hero-section position-relative text-center text-white">
        <div class="hero-overlay position-absolute w-100 h-100"></div>
        <div class="container position-relative">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="hero-content animate__animated animate__fadeInUp">
                        <h1 class="display-3 mb-4 fw-bold text-shadow">
                            Empowering Minds, 
                            <br>
                            <span class="text-orange">Inspiring Futures</span>
                        </h1>
                        <p class="lead mb-5 text-shadow">
                            Where Education Meets Innovation, and Learning Knows No Boundaries
                        </p>
                        <div class="d-flex justify-content-center">
                            <a href="#announcements" class="btn btn-primary btn-lg me-3 shadow-lg">
                                <i class="fas fa-newspaper me-2"></i>Discover More
                            </a>
                            <a href="#portals" class="btn btn-outline-primary btn-lg shadow-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Access Portals
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    <section id="announcements" class="py-5 bg-orange text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="display-6">School Announcements</h2>
                    <hr class="border-orange">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-light text-orange">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-bullhorn me-2"></i>Upcoming Events</h5>
                            <p class="card-text">Stay updated with our latest school events and important dates.</p>
                            <a href="#" class="btn btn-success">View Calendar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-light text-orange">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-cloud-sun me-2"></i>Weather Updates</h5>
                            <p class="card-text">Check current weather conditions that might affect school operations.</p>
                            <a href="#" class="btn btn-danger">Check Weather</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-light text-orange">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-bell me-2"></i>Class Suspension</h5>
                            <p class="card-text">Latest information on class suspensions and emergency notifications.</p>
                            <a href="#" class="btn btn-primary">View Alerts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Vision Section -->
    <section class="mission-vision-section bg-light py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="display-4 text-primary mb-3">Our Guiding Principles</h2>
                    <p class="lead text-muted">Empowering Minds, Inspiring Futures</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-primary">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <span class="badge bg-primary-subtle text-primary p-2 rounded-circle">
                                    <i class="fas fa-bullseye fa-2x"></i>
                                </span>
                            </div>
                            <h3 class="card-title text-primary mb-3">Our Mission</h3>
                            <p class="card-text text-muted">
                                To provide a transformative educational experience that nurtures intellectual curiosity, 
                                critical thinking, and personal growth. We are committed to developing well-rounded 
                                individuals who are prepared to lead, innovate, and make meaningful contributions 
                                to society.
                            </p>
                        </div>
                    </div>      
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-primary">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <span class="badge bg-primary-subtle text-primary p-2 rounded-circle">
                                    <i class="fas fa-eye fa-2x"></i>
                                </span>
                            </div>
                            <h3 class="card-title text-primary mb-3">Our Vision</h3>
                            <p class="card-text text-muted">
                                To be a globally recognized institution that sets the standard for excellence 
                                in education, where innovative learning, technological integration, and holistic 
                                development create empowered, compassionate, and future-ready global citizens.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="#" class="btn btn-primary btn-lg px-4 py-2">
                        Learn More About Our Journey
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Access Portals Section -->
    <section id="portals" class="py-5 bg-orange text-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2 class="display-6">Access Portals</h2>
                    <hr class="border-orange">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-light text-orange text-center">
                        <div class="card-body">
                            <i class="fas fa-user-graduate fa-3x mb-3 text-orange"></i>
                            <h4 class="card-title">Parent Portal</h4>
                            <p class="card-text">Track your child's academic progress and school activities.</p>
                            <a href="parent/parent-login.html" class="btn btn-secondary">Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-light text-orange text-center">
                        <div class="card-body">
                            <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-orange"></i>
                            <h4 class="card-title">Teacher Portal</h4>
                            <p class="card-text">Manage classes, grades, and student information.</p>
                            <a href="teacher/teacher-login.html" class="btn btn-secondary">Login</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 bg-light text-orange text-center">
                        <div class="card-body">
                            <i class="fas fa-user-shield fa-3x mb-3 text-orange"></i>
                            <h4 class="card-title">Admin Portal</h4>
                            <p class="card-text">School administration and management system.</p>
                            <a href="admin/admin-login.php" class="btn btn-secondary">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Calendar and Location Section -->
    <section id="school-calendar" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>School Calendar
                            </h3>
                        </div>
                        <div class="card-body">
                            <!-- Placeholder for Calendar Component -->
                            <div id="school-calendar-widget" class="mb-3">
                                <!-- Calendar will be dynamically loaded here -->
                            </div>
                            <a href="#" class="btn btn-success">
                                <i class="fas fa-eye me-2"></i>View Full Calendar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>School Location
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="map-responsive">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3306.2661744827!2d-118.24368968468285!3d34.05217388061157!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c7b85dea2a93%3A0x1ff47c3ceb7bb2d5!2sDowntown%2C%20Los%20Angeles%2C%20CA!5e0!3m2!1sen!2sus!4v1677777777777!5m2!1sen!2sus" 
                                    width="100%" 
                                    height="350" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                            <div class="p-3">
                                <h5 class="card-title">Schola Angelus Agape</h5>
                                <p class="card-text">
                                    <i class="fas fa-map-pin me-2"></i>
                                    Blk2 L1-3 Phase1 Centennial Homes, Brgy Pulo, Cabuyao City, Laguna, Cabuyao, Philippines
                                </p>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fas fa-directions me-2"></i>Get Directions
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Full Calendar -->
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="calendarModalLabel">
                        <i class="fas fa-calendar-alt me-2"></i>School Calendar
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="fullCalendar"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./script/calendar.js"></script>
</body>
</html>
