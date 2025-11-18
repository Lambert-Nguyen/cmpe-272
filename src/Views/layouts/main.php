<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Enterprise Marketplace | CMPE 272'); ?></title>
    
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
                <i class="fas fa-store me-2"></i>
                <span class="brand-text">Enterprise Marketplace</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/marketplace">
                            <i class="fas fa-store me-1"></i>Marketplace
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link modern-nav-link" href="/marketplace/companies">
                            <i class="fas fa-building me-1"></i>Companies
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle modern-nav-link" href="#" id="topProductsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-trophy me-1"></i>Top Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="topProductsDropdown">
                            <li><a class="dropdown-item" href="/marketplace/top5"><i class="fas fa-star me-2"></i>Marketplace Top 5</a></li>
                            <li><a class="dropdown-item" href="/marketplace/company-top5"><i class="fas fa-building me-2"></i>Top 5 by Company</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle modern-nav-link" href="#" id="companyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-briefcase me-1"></i>Company
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                            <li><a class="dropdown-item" href="/company/about"><i class="fas fa-info-circle me-2"></i>About</a></li>
                            <li><a class="dropdown-item" href="/company/products"><i class="fas fa-cogs me-2"></i>Services</a></li>
                            <li><a class="dropdown-item" href="/company/news"><i class="fas fa-newspaper me-2"></i>News</a></li>
                            <li><a class="dropdown-item" href="/company/contacts"><i class="fas fa-phone me-2"></i>Contacts</a></li>
                        </ul>
                    </li>
                    <?php
                    require_once __DIR__ . '/../../Controllers/AuthController.php';
                    $isLoggedIn = AuthController::isLoggedIn();
                    $currentUser = AuthController::getCurrentUser();
                    ?>
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link modern-nav-link" href="/marketplace/wishlist">
                                <i class="fas fa-heart me-1"></i>Wishlist
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle modern-nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i><?= htmlspecialchars($currentUser['username']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i>My Profile</a></li>
                                <li><a class="dropdown-item" href="/marketplace/wishlist"><i class="fas fa-heart me-2"></i>My Wishlist</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link modern-nav-link" href="/login">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link modern-nav-link btn btn-primary text-white" href="/register">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true): ?>
                        <li class="nav-item">
                            <a class="nav-link modern-nav-link text-warning" href="/admin/users">
                                <i class="fas fa-shield-halved me-1"></i>Admin
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