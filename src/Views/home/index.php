<?php ob_start(); ?>

<div class="container">
    <!-- Hero Section -->
    <section class="hero-section" data-aos="fade-up">
        <div class="hero-content text-center">
            <h1 class="hero-title">Welcome to SJSU CMPE 272</h1>
            <p class="hero-subtitle">Enterprise Software Platforms</p>
            <p class="hero-subtitle">Built by <strong><?php echo htmlspecialchars($student_name); ?></strong> • Course: <strong><?php echo htmlspecialchars($course); ?></strong></p>
            <p class="hero-subtitle">Taught by <strong><?php echo htmlspecialchars($professor); ?></strong> at <strong><?php echo htmlspecialchars($university); ?></strong></p>
            <div class="hero-description">
                <p>A modern PHP MVC web application featuring elegant design, robust architecture, and seamless deployment capabilities on Render platform with MySQL database integration.</p>
            </div>
            <div class="hero-buttons">
                <a href="/users" class="btn-modern btn-modern-primary">
                    <i class="fas fa-users"></i>
                    Explore Users
                </a>
                <a href="/about" class="btn-modern btn-modern-outline">
                    <i class="fas fa-info-circle"></i>
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="section-padding">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <div class="modern-card-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3 class="modern-card-title">MVC Architecture</h3>
                        <p class="modern-card-text">
                            Built with a custom MVC pattern ensuring clean separation of concerns, maintainable code structure, and scalable development practices.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <div class="modern-card-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="modern-card-title">MySQL Integration</h3>
                        <p class="modern-card-text">
                            Comprehensive CRUD operations with MySQL database, featuring prepared statements for security and optimized for Render's managed services.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <div class="modern-card-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <h3 class="modern-card-title">Cloud Ready</h3>
                        <p class="modern-card-text">
                            Designed for seamless deployment on Render platform with environment variable configuration and production-ready optimization.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <div class="modern-card-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="modern-card-title">Security First</h3>
                        <p class="modern-card-text">
                            Implements security best practices including prepared statements, input validation, XSS protection, and secure environment configuration.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <div class="modern-card-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="modern-card-title">Responsive Design</h3>
                        <p class="modern-card-text">
                            Modern, mobile-first responsive design with Bootstrap 5, custom animations, and elegant UI components for all devices.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <div class="modern-card-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="modern-card-title">Modern Stack</h3>
                        <p class="modern-card-text">
                            Built with PHP 8+, modern CSS3 features, ES6+ JavaScript, and contemporary web development best practices and patterns.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section-padding" data-aos="fade-up">
        <div class="modern-card">
            <div class="card-body p-5">
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="display-4 text-gradient mb-2">
                            <i class="fas fa-code"></i>
                        </div>
                        <h5 class="modern-card-title">PHP 8+</h5>
                        <p class="text-muted">Modern PHP</p>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="display-4 text-gradient mb-2">
                            <i class="fas fa-database"></i>
                        </div>
                        <h5 class="modern-card-title">MySQL</h5>
                        <p class="text-muted">Database</p>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="display-4 text-gradient mb-2">
                            <i class="fab fa-bootstrap"></i>
                        </div>
                        <h5 class="modern-card-title">Bootstrap</h5>
                        <p class="text-muted">UI Framework</p>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="display-4 text-gradient mb-2">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <h5 class="modern-card-title">Render</h5>
                        <p class="text-muted">Cloud Platform</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>