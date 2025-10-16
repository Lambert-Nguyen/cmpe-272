<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'CMPE 272 PHP App'); ?></title>
    
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="modern-body">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg modern-navbar fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand modern-brand" href="/">
                <i class="fas fa-building me-2"></i>
                <span class="brand-text">Lambert Nguyen Company</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/company/about">
                            <i class="fas fa-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/company/products">
                            <i class="fas fa-cogs me-1"></i>Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/company/news">
                            <i class="fas fa-newspaper me-1"></i>News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/Labs/">
                            <i class="fas fa-flask me-1"></i>Labs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/company/contacts">
                            <i class="fas fa-phone me-1"></i>Contacts
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle modern-nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tools me-1"></i>CMPE 272
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/about"><i class="fas fa-info-circle me-2"></i>About Course</a></li>
                            <li><a class="dropdown-item" href="/users"><i class="fas fa-users me-2"></i>Users</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
                        <li class="nav-item">
                            <a class="nav-link modern-nav-link text-warning" href="/admin/users">
                                <i class="fas fa-shield-halved me-1"></i>Admin
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link modern-nav-link" href="/admin/login">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <footer class="modern-footer" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-brand">
                        <i class="fas fa-code me-2"></i>
                        <span>CMPE 272 Project</span>
                    </div>
                    <p class="footer-description">
                        A modern PHP MVC application built for enterprise software platforms course.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-info">
                        <div class="info-item">
                            <i class="fas fa-user me-2"></i>
                            <span>Lam Nguyen</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-university me-2"></i>
                            <span>San Jose State University</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-chalkboard-teacher me-2"></i>
                            <span>Prof. Richard Sinn</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="text-center footer-copyright">
                <p>&copy; 2025 CMPE 272 Project - Nguyen Phuong Duy Lam. Built with <i class="fas fa-heart text-danger"></i> for learning.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Add active class to current navigation item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>