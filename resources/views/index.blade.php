<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Portal Home</title>

    <!-- Bootstrap 5.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #e0e8ff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .hero {
            padding: 120px 0 80px 0;
        }
        .card-icon {
            font-size: 3rem;
            color: #0d6efd;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold">EduTracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/login_stu">Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/login_tea">Teacher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/api/adm_login">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-5 fw-bold">Unified Learning Hub</h1>
            <p class="lead mb-4">Monitor progress, manage attendance and empower learning — all in one place.</p>
            <a href="/api/login_stu" class="btn btn-primary btn-lg me-2">Student Login</a>
            <a href="/api/login_tea" class="btn btn-outline-primary btn-lg">Teacher Login</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-bar-chart-line card-icon"></i>
                            <h5 class="card-title mt-3">Marks Insight</h5>
                            <p class="card-text">View subject‑wise marks, compare with class averages and track improvement over time.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history card-icon"></i>
                            <h5 class="card-title mt-3">Attendance</h5>
                            <p class="card-text">Stay updated with live attendance, monthly summaries and automated alerts for low percentages.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-lines-fill card-icon"></i>
                            <h5 class="card-title mt-3">Progress Chart</h5>
                            <p class="card-text">Interactive charts help visualize academic growth across semesters for both student and teacher dashboards.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-bell card-icon"></i>
                            <h5 class="card-title mt-3">Alerts</h5>
                            <p class="card-text">Receive real‑time notifications for upcoming exams, assignment deadlines and attendance shortages.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-clipboard-data card-icon"></i>
                            <h5 class="card-title mt-3">Analytics</h5>
                            <p class="card-text">Teachers can drill down into class performance metrics to identify strengths and areas for improvement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4 text-center shadow-sm">
        <div class="container">
            <p class="mb-0">© 2025 EduTracker. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5.0 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
