<?php ob_start(); ?>

<!-- Full-width Hero Banner with Background Image -->
<div class="hero-banner-home" data-aos="fade-in">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-banner-content text-center">
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
                <span><i class="fas fa-user me-2"></i><strong><?php echo htmlspecialchars($student_name); ?></strong></span>
                <span class="mx-3">•</span>
                <span><i class="fas fa-chalkboard-teacher me-2"></i>Prof. <?php echo htmlspecialchars($professor); ?></span>
                <span class="mx-3">•</span>
                <span><i class="fas fa-university me-2"></i><?php echo htmlspecialchars($university); ?></span>
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
                <a href="/admin/users" class="btn-hero btn-hero-outline">
                    <i class="fas fa-shield-alt me-2"></i>
                    Admin Portal
                </a>
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
    <section class="section-padding bg-light">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title-modern">Technology Stack & Features</h2>
            <p class="section-subtitle-modern">Built with modern enterprise-grade technologies</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="tech-card">
                    <div class="tech-icon-wrapper">
                        <i class="fas fa-layer-group fa-3x"></i>
                    </div>
                    <h4>MVC Architecture</h4>
                    <p>Custom PHP MVC pattern with clean separation of concerns</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="tech-card">
                    <div class="tech-icon-wrapper">
                        <i class="fas fa-database fa-3x"></i>
                    </div>
                    <h4>MySQL Database</h4>
                    <p>Robust data management with prepared statements</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="tech-card">
                    <div class="tech-icon-wrapper">
                        <i class="fas fa-cloud fa-3x"></i>
                    </div>
                    <h4>Cloud Deploy</h4>
                    <p>Production-ready deployment on Render platform</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="tech-card">
                    <div class="tech-icon-wrapper">
                        <i class="fas fa-shield-alt fa-3x"></i>
                    </div>
                    <h4>Secure by Design</h4>
                    <p>XSS protection, input validation, session security</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links Section -->
    <section class="section-padding">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h4>Course Materials</h4>
                    <p>Access assignments, labs, and documentation</p>
                    <a href="/about" class="quick-link-btn">View More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h4>Interactive Labs</h4>
                    <p>Explore HTML5 Canvas animations and experiments</p>
                    <a href="/Labs/" class="quick-link-btn">Try Labs <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <h4>Contact & Support</h4>
                    <p>Get in touch with our team for assistance</p>
                    <a href="/company/contacts" class="quick-link-btn">Contact Us <i class="fas fa-arrow-right ms-2"></i></a>
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
    min-height: 600px;
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
    opacity: 0.15;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
}

.hero-banner-content {
    position: relative;
    z-index: 2;
    padding: 80px 20px;
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
    font-size: 1.1rem;
    margin-bottom: 40px;
    opacity: 0.9;
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
.tech-card {
    background: white;
    padding: 2.5rem 1.5rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.tech-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.tech-icon-wrapper {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.tech-card h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.tech-card p {
    color: #718096;
    font-size: 0.95rem;
}

/* Quick Link Cards */
.quick-link-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    text-align: center;
}

.quick-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.quick-link-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: #667eea;
}

.quick-link-card h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 0.75rem;
}

.quick-link-card p {
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

/* Section Titles */
.section-title-modern {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
}

.section-subtitle-modern {
    font-size: 1.2rem;
    color: #718096;
}

/* Responsive Design */
@media (max-width: 768px) {
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
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>