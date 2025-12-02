<?php ob_start(); ?>

<!-- Full-width Hero Banner with Background Image and Particles -->
<div class="hero-banner-home" data-aos="fade-in">
    <div class="hero-particles"></div>
    <div class="hero-overlay"></div>
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-banner-content">
                    <div class="hero-badge mb-4" data-aos="fade-up" data-aos-delay="100">
                        <i class="fas fa-graduation-cap me-2"></i>
                        SJSU CMPE 272 - Enterprise Software Platforms
                    </div>
                    <h1 class="hero-banner-title" data-aos="fade-up" data-aos-delay="200">
                        Lambert Nguyen Company
                    </h1>
                    <p class="hero-banner-subtitle" data-aos="fade-up" data-aos-delay="300">
                        Building Next-Generation Enterprise Solutions with Modern Technology
                    </p>
                    <div class="hero-meta" data-aos="fade-up" data-aos-delay="400">
                        <div class="meta-item">
                            <i class="fas fa-user"></i>
                            <strong><?php echo htmlspecialchars($student_name); ?></strong>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-chalkboard-teacher"></i>
                            Prof. <?php echo htmlspecialchars($professor); ?>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-university"></i>
                            <?php echo htmlspecialchars($university); ?>
                        </div>
                    </div>
                    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="500">
                        <a href="/company/products" class="btn-hero btn-hero-primary">
                            <i class="fas fa-rocket me-2"></i>
                            Explore Services
                        </a>
                        <a href="/combined-users" class="btn-hero btn-hero-outline">
                            <i class="fas fa-network-wired me-2"></i>
                            CURL Integration
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                <div class="hero-image-container">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=600&fit=crop&q=80"
                         alt="Enterprise Technology Solutions"
                         class="hero-main-image">
                    <div class="floating-card floating-card-1">
                        <i class="fas fa-code"></i>
                        <span>PHP MVC</span>
                    </div>
                    <div class="floating-card floating-card-2">
                        <i class="fas fa-database"></i>
                        <span>MySQL</span>
                    </div>
                    <div class="floating-card floating-card-3">
                        <i class="fas fa-cloud"></i>
                        <span>Cloud Ready</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Homework Showcase Section -->
    <section class="section-padding">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title-modern">Course Projects & Assignments</h2>
            <p class="section-subtitle-modern">Hands-on implementation of enterprise software concepts</p>
        </div>
        
        <div class="row g-4">
            <!-- Project 1: Cookie Tracking -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="homework-card">
                    <div class="homework-image-section">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" 
                             alt="Cookie Tracking Lab"
                             class="homework-card-image">
                        <div class="homework-overlay">
                            <span class="homework-date"><i class="fas fa-calendar me-2"></i>Oct 23, 2025</span>
                        </div>
                    </div>
                    <div class="homework-card-body">
                        <div class="homework-badge">
                            <i class="fas fa-cookie-bite me-2"></i>Web Cookies
                        </div>
                        <h3 class="homework-card-title">Product Tracking System</h3>
                        <p class="homework-card-desc">
                            Implemented cookie-based tracking for 10 products with recently visited and most visited analytics.
                        </p>
                        <div class="homework-features">
                            <span><i class="fas fa-check-circle me-1"></i>Cookie Management</span>
                            <span><i class="fas fa-check-circle me-1"></i>Visit Analytics</span>
                            <span><i class="fas fa-check-circle me-1"></i>10 Products</span>
                        </div>
                        <a href="/company/products" class="btn btn-primary w-100 mt-3">
                            View Products <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Project 2: Admin Secure Section -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="homework-card">
                    <div class="homework-image-section">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=600&h=400&fit=crop" 
                             alt="Admin Secure Section"
                             class="homework-card-image">
                        <div class="homework-overlay">
                            <span class="homework-date"><i class="fas fa-calendar me-2"></i>Oct 9, 2025</span>
                        </div>
                    </div>
                    <div class="homework-card-body">
                        <div class="homework-badge">
                            <i class="fas fa-lock me-2"></i>Authentication
                        </div>
                        <h3 class="homework-card-title">Secure Admin Portal</h3>
                        <p class="homework-card-desc">
                            Session-based authentication system with protected routes and user management dashboard.
                        </p>
                        <div class="homework-features">
                            <span><i class="fas fa-check-circle me-1"></i>Session Auth</span>
                            <span><i class="fas fa-check-circle me-1"></i>15 Users</span>
                            <span><i class="fas fa-check-circle me-1"></i>Access Control</span>
                        </div>
                        <a href="/admin/login" class="btn btn-warning w-100 mt-3">
                            Admin Login <i class="fas fa-sign-in-alt ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Project 3: CURL Integration -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="homework-card">
                    <div class="homework-image-section">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop" 
                             alt="CURL Integration"
                             class="homework-card-image">
                        <div class="homework-overlay">
                            <span class="homework-date"><i class="fas fa-calendar me-2"></i>Oct 30, 2025</span>
                        </div>
                    </div>
                    <div class="homework-card-body">
                        <div class="homework-badge">
                            <i class="fas fa-exchange-alt me-2"></i>API Integration
                        </div>
                        <h3 class="homework-card-title">Multi-Company CURL</h3>
                        <p class="homework-card-desc">
                            PHP CURL implementation to aggregate user data from multiple partner companies via REST APIs.
                        </p>
                        <div class="homework-features">
                            <span><i class="fas fa-check-circle me-1"></i>CURL Requests</span>
                            <span><i class="fas fa-check-circle me-1"></i>3 Companies</span>
                            <span><i class="fas fa-check-circle me-1"></i>REST API</span>
                        </div>
                        <a href="/combined-users" class="btn btn-info w-100 mt-3">
                            View Integration <i class="fas fa-network-wired ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack Section with Images -->
    <section class="section-padding bg-tech">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title-modern">Technology Stack & Features</h2>
            <p class="section-subtitle-modern">Built with modern enterprise-grade technologies</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="tech-card">
                    <div class="tech-image-bg" style="background-image: url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=300&fit=crop&q=80');"></div>
                    <div class="tech-card-overlay">
                        <div class="tech-icon-wrapper">
                            <i class="fas fa-layer-group fa-3x"></i>
                        </div>
                        <h4>MVC Architecture</h4>
                        <p>Custom PHP MVC pattern with clean separation of concerns</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="tech-card">
                    <div class="tech-image-bg" style="background-image: url('https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=400&h=300&fit=crop&q=80');"></div>
                    <div class="tech-card-overlay">
                        <div class="tech-icon-wrapper">
                            <i class="fas fa-database fa-3x"></i>
                        </div>
                        <h4>MySQL Database</h4>
                        <p>Robust data management with prepared statements</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="tech-card">
                    <div class="tech-image-bg" style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=300&fit=crop&q=80');"></div>
                    <div class="tech-card-overlay">
                        <div class="tech-icon-wrapper">
                            <i class="fas fa-cloud fa-3x"></i>
                        </div>
                        <h4>Cloud Deploy</h4>
                        <p>Production-ready deployment on Render platform</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="tech-card">
                    <div class="tech-image-bg" style="background-image: url('https://images.unsplash.com/photo-1614064641938-3bbee52942c7?w=400&h=300&fit=crop&q=80');"></div>
                    <div class="tech-card-overlay">
                        <div class="tech-icon-wrapper">
                            <i class="fas fa-shield-alt fa-3x"></i>
                        </div>
                        <h4>Secure by Design</h4>
                        <p>XSS protection, input validation, session security</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section with Images -->
    <section class="section-padding">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="quick-link-card">
                    <div class="quick-link-image">
                        <img src="https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?w=600&h=400&fit=crop&q=80"
                             alt="Course Materials">
                        <div class="quick-link-overlay">
                            <div class="quick-link-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                    </div>
                    <div class="quick-link-content">
                        <h4>Course Materials</h4>
                        <p>Access assignments, labs, and documentation</p>
                        <a href="/about" class="quick-link-btn">View More <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="quick-link-card">
                    <div class="quick-link-image">
                        <img src="https://images.unsplash.com/photo-1507537297725-24a1c029d3ca?w=600&h=400&fit=crop&q=80"
                             alt="Interactive Labs">
                        <div class="quick-link-overlay">
                            <div class="quick-link-icon">
                                <i class="fas fa-flask"></i>
                            </div>
                        </div>
                    </div>
                    <div class="quick-link-content">
                        <h4>Interactive Labs</h4>
                        <p>Explore HTML5 Canvas animations and experiments</p>
                        <a href="/Labs/" class="quick-link-btn">Try Labs <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="quick-link-card">
                    <div class="quick-link-image">
                        <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=600&h=400&fit=crop&q=80"
                             alt="Contact Support">
                        <div class="quick-link-overlay">
                            <div class="quick-link-icon">
                                <i class="fas fa-address-book"></i>
                            </div>
                        </div>
                    </div>
                    <div class="quick-link-content">
                        <h4>Contact & Support</h4>
                        <p>Get in touch with our team for assistance</p>
                        <a href="/company/contacts" class="quick-link-btn">Contact Us <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visual Gallery Section -->
    <section class="section-padding bg-light">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title-modern">Our Innovation Showcase</h2>
            <p class="section-subtitle-modern">Visual highlights of our enterprise solutions</p>
        </div>

        <div class="row g-3">
            <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
                <div class="gallery-item gallery-item-large">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop&q=80"
                         alt="Data Analytics Dashboard">
                    <div class="gallery-overlay">
                        <div class="gallery-content">
                            <h3>Data Analytics Dashboard</h3>
                            <p>Real-time insights and business intelligence</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-3">
                    <div class="col-12" data-aos="fade-left" data-aos-delay="200">
                        <div class="gallery-item gallery-item-small">
                            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&h=400&fit=crop&q=80"
                                 alt="Cloud Infrastructure">
                            <div class="gallery-overlay">
                                <div class="gallery-content">
                                    <h4>Cloud Infrastructure</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" data-aos="fade-left" data-aos-delay="300">
                        <div class="gallery-item gallery-item-small">
                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=400&fit=crop&q=80"
                                 alt="API Integration">
                            <div class="gallery-overlay">
                                <div class="gallery-content">
                                    <h4>Seamless API Integration</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="stats-banner" data-aos="fade-up">
        <div class="row text-center g-0">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Major Projects</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">24</div>
                    <div class="stat-label">Total Users</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">10</div>
                    <div class="stat-label">Products</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Cloud Ready</div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Hero Banner Styles */
.hero-banner-home {
    position: relative;
    min-height: 700px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-top: -20px;
}

.hero-banner-home::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&h=1080&fit=crop') center/cover;
    opacity: 0.1;
}

.hero-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
}

.hero-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.shape {
    position: absolute;
    border-radius: 50%;
    filter: blur(40px);
    opacity: 0.2;
    animation: float 20s infinite ease-in-out;
}

.shape-1 {
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.3);
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.2);
    bottom: 20%;
    right: 15%;
    animation-delay: 5s;
}

.shape-3 {
    width: 250px;
    height: 250px;
    background: rgba(255, 255, 255, 0.25);
    top: 50%;
    left: 50%;
    animation-delay: 10s;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(50px, 50px) scale(1.1); }
}

.hero-banner-content {
    position: relative;
    z-index: 2;
    padding: 80px 0;
    color: white;
}

.hero-badge {
    display: inline-block;
    padding: 12px 24px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    font-size: 0.95rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.hero-banner-title {
    font-size: 4rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.hero-banner-subtitle {
    font-size: 1.5rem;
    margin-bottom: 30px;
    opacity: 0.95;
}

.hero-meta {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 40px;
    opacity: 0.95;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1rem;
}

.meta-item i {
    width: 24px;
    text-align: center;
}

/* Hero Image Container */
.hero-image-container {
    position: relative;
    z-index: 2;
}

.hero-main-image {
    width: 100%;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.hero-main-image:hover {
    transform: scale(1.02);
}

.floating-card {
    position: absolute;
    background: white;
    border-radius: 12px;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    animation: floatCard 3s ease-in-out infinite;
    z-index: 3;
}

.floating-card i {
    font-size: 1.5rem;
    color: #667eea;
}

.floating-card span {
    font-weight: 600;
    color: #2d3748;
}

.floating-card-1 {
    top: 10%;
    right: -10%;
    animation-delay: 0s;
}

.floating-card-2 {
    bottom: 30%;
    left: -10%;
    animation-delay: 1s;
}

.floating-card-3 {
    bottom: 10%;
    right: 10%;
    animation-delay: 2s;
}

@keyframes floatCard {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.hero-buttons {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-hero {
    padding: 15px 35px;
    font-size: 1.05rem;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.btn-hero-primary {
    background: white;
    color: #667eea;
}

.btn-hero-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    color: #667eea;
}

.btn-hero-outline {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-hero-outline:hover {
    background: white;
    color: #667eea;
    transform: translateY(-3px);
}

/* Homework Card Styles */
.homework-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
    height: 100%;
}

.homework-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.homework-image-section {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.homework-card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.homework-card:hover .homework-card-image {
    transform: scale(1.08);
}

.homework-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    display: flex;
    align-items: flex-end;
    padding: 20px;
}

.homework-date {
    color: white;
    font-weight: 500;
    font-size: 0.9rem;
}

.homework-card-body {
    padding: 1.5rem;
}

.homework-badge {
    display: inline-block;
    padding: 6px 14px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.homework-card-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.homework-card-desc {
    color: #4a5568;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.homework-features {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 1rem;
}

.homework-features span {
    font-size: 0.85rem;
    color: #718096;
}

/* Tech Card Styles */
.bg-tech {
    background: #f7fafc;
}

.tech-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
    height: 300px;
    position: relative;
}

.tech-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.tech-image-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-size: cover;
    background-position: center;
    transition: transform 0.3s ease;
}

.tech-card:hover .tech-image-bg {
    transform: scale(1.1);
}

.tech-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.8) 100%);
    padding: 2rem 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    text-align: center;
    color: white;
}

.tech-icon-wrapper {
    width: 70px;
    height: 70px;
    margin: 0 auto 1rem;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.tech-card-overlay h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
}

.tech-card-overlay p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
}

/* Quick Link Cards */
.quick-link-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease;
    height: 100%;
}

.quick-link-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}

.quick-link-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.quick-link-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.quick-link-card:hover .quick-link-image img {
    transform: scale(1.1);
}

.quick-link-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(102, 126, 234, 0.9) 100%);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding: 1.5rem;
}

.quick-link-icon {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #667eea;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.quick-link-content {
    padding: 1.5rem;
    text-align: center;
}

.quick-link-content h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.quick-link-content p {
    color: #718096;
    margin-bottom: 1.5rem;
}

.quick-link-btn {
    display: inline-flex;
    align-items: center;
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
}

.quick-link-btn:hover {
    color: #764ba2;
    transform: translateX(5px);
}

/* Stats Banner */
.stats-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 3rem 1rem;
    margin-bottom: 2rem;
}

.stat-item {
    padding: 1rem;
    color: white;
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.9;
}

/* Section Utilities */
.section-padding {
    padding: 5rem 0;
}

.bg-light {
    background-color: #f7fafc !important;
}

.section-title-modern {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
}

.section-subtitle-modern {
    font-size: 1.2rem;
    color: #718096;
}

/* Gallery Section */
.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
}

.gallery-item-large {
    height: 500px;
}

.gallery-item-small {
    height: 240px;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.8) 100%);
    display: flex;
    align-items: flex-end;
    padding: 2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-content h3,
.gallery-content h4 {
    color: white;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.gallery-content h3 {
    font-size: 1.8rem;
}

.gallery-content h4 {
    font-size: 1.4rem;
}

.gallery-content p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-banner-home {
        min-height: 600px;
    }

    .hero-banner-title {
        font-size: 2.5rem;
    }

    .hero-banner-subtitle {
        font-size: 1.1rem;
    }

    .hero-meta {
        font-size: 0.9rem;
    }

    .hero-buttons {
        flex-direction: column;
    }

    .btn-hero {
        width: 100%;
        justify-content: center;
    }

    .hero-image-container {
        margin-top: 3rem;
    }

    .floating-card {
        padding: 10px 15px;
        font-size: 0.85rem;
    }

    .floating-card i {
        font-size: 1.2rem;
    }

    .floating-card-1 {
        right: 0;
    }

    .floating-card-2 {
        left: 0;
    }

    .stat-number {
        font-size: 2rem;
    }

    .tech-card {
        height: 250px;
    }

    .homework-image-section {
        height: 180px;
    }

    .quick-link-image {
        height: 160px;
    }

    .gallery-item-large {
        height: 300px;
    }

    .gallery-item-small {
        height: 200px;
    }

    .gallery-content h3 {
        font-size: 1.3rem;
    }

    .gallery-content h4 {
        font-size: 1.1rem;
    }

    .gallery-overlay {
        padding: 1.5rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>