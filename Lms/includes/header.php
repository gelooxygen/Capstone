<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Schola Angelus Agape - Learning Management System</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #FF9D23;
            --secondary-color: #C14600;
            --light-color: #E5D0AC;
            --background-color: #FEF9E1;
        }

        .elegant-navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 15px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: var(--background-color) !important;
            font-family: 'Comic Neue', cursive;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
            border: 2px solid var(--light-color);
            transition: transform 0.3s ease;
        }

        .navbar-brand img:hover {
            transform: scale(1.1);
        }

        .navbar-nav .nav-link {
            color: var(--background-color) !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: var(--light-color);
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover::before {
            width: 100%;
            left: 0;
        }

        .navbar-nav .nav-link:hover {
            color: var(--light-color) !important;
        }

        .dropdown-menu {
            background-color: var(--secondary-color);
            border: none;
        }

        .dropdown-menu .dropdown-item {
            color: var(--background-color) !important;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: var(--primary-color);
        }

        @media (max-width: 991px) {
            .navbar-nav {
                text-align: center;
                background-color: var(--secondary-color);
                padding: 15px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Elegant Navigation -->
    <nav class="navbar navbar-expand-lg elegant-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/Lms/images/logo.jpg" alt="Schola Angelus Agape Logo">
                Schola Angelus Agape
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Portals
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="parent/parent-login.html">
                                <i class="fas fa-user-graduate me-2"></i>Parent Portal
                            </a></li>
                            <li><a class="dropdown-item" href="teacher/teacher-login.html">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Teacher Portal
                            </a></li>
                            <li><a class="dropdown-item" href="admin/admin-login.php">
                                <i class="fas fa-user-shield me-2"></i>Admin Portal
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
