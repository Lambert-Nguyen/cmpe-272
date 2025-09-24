<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <div class="text-center mb-5" data-aos="fade-down">
        <h1 class="text-gradient"><?php echo htmlspecialchars($title); ?></h1>
        <p class="lead text-muted"><?php echo htmlspecialchars($description); ?></p>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Features Section -->
            <div class="modern-card mb-4" data-aos="fade-right">
                <div class="card-body p-4">
                    <h3 class="modern-card-title">
                        <i class="fas fa-star me-2"></i>Key Features
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon me-3">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                        <div>
                                            <strong>Custom MVC Framework</strong>
                                            <br><small class="text-muted">Clean architecture pattern</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon me-3">
                                            <i class="fas fa-database"></i>
                                        </div>
                                        <div>
                                            <strong>MySQL Integration</strong>
                                            <br><small class="text-muted">Full CRUD operations</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon me-3">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div>
                                            <strong>Responsive Design</strong>
                                            <br><small class="text-muted">Mobile-first approach</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon me-3">
                                            <i class="fab fa-bootstrap"></i>
                                        </div>
                                        <div>
                                            <strong>Bootstrap 5</strong>
                                            <br><small class="text-muted">Modern UI components</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon me-3">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div>
                                            <strong>Security First</strong>
                                            <br><small class="text-muted">Environment variables</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="feature-icon me-3">
                                            <i class="fas fa-cloud"></i>
                                        </div>
                                        <div>
                                            <strong>Render Ready</strong>
                                            <br><small class="text-muted">Cloud deployment</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Technology Stack -->
            <div class="modern-card" data-aos="fade-right" data-aos-delay="200">
                <div class="card-body p-4">
                    <h3 class="modern-card-title">
                        <i class="fas fa-code me-2"></i>Technology Stack
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-gradient mb-3">Backend</h5>
                            <div class="tech-stack">
                                <div class="tech-item">
                                    <i class="fab fa-php text-primary"></i>
                                    <span>PHP 8.0+</span>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-database text-info"></i>
                                    <span>PDO for Database</span>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-layer-group text-success"></i>
                                    <span>Custom MVC Pattern</span>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-shield-alt text-warning"></i>
                                    <span>Security Best Practices</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-gradient mb-3">Frontend</h5>
                            <div class="tech-stack">
                                <div class="tech-item">
                                    <i class="fab fa-bootstrap text-purple"></i>
                                    <span>Bootstrap 5</span>
                                </div>
                                <div class="tech-item">
                                    <i class="fab fa-css3-alt text-info"></i>
                                    <span>Modern CSS3</span>
                                </div>
                                <div class="tech-item">
                                    <i class="fab fa-js text-warning"></i>
                                    <span>ES6+ JavaScript</span>
                                </div>
                                <div class="tech-item">
                                    <i class="fas fa-palette text-danger"></i>
                                    <span>Custom Animations</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Course Information -->
            <div class="modern-card mb-4" data-aos="fade-left">
                <div class="card-body p-4">
                    <h5 class="modern-card-title">
                        <i class="fas fa-graduation-cap me-2"></i>Course Information
                    </h5>
                    <div class="info-list">
                        <div class="info-item">
                            <i class="fas fa-user text-primary"></i>
                            <div>
                                <strong>Student</strong>
                                <br>Lam Nguyen
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-book text-success"></i>
                            <div>
                                <strong>Course</strong>
                                <br>CMPE 272
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-chalkboard-teacher text-info"></i>
                            <div>
                                <strong>Professor</strong>
                                <br>Prof. Richard Sinn
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-university text-warning"></i>
                            <div>
                                <strong>University</strong>
                                <br>San Jose State University
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="modern-card" data-aos="fade-left" data-aos-delay="200">
                <div class="card-body p-4 text-center">
                    <h5 class="modern-card-title">
                        <i class="fas fa-rocket me-2"></i>Quick Actions
                    </h5>
                    <div class="d-grid gap-3">
                        <a href="/users" class="btn-modern btn-modern-primary">
                            <i class="fas fa-users me-2"></i>
                            View Users
                        </a>
                        <a href="/users/create" class="btn-modern btn-modern-secondary">
                            <i class="fas fa-user-plus me-2"></i>
                            Add User
                        </a>
                        <a href="/" class="btn-modern btn-modern-outline" style="border: 2px solid var(--primary-color); color: var(--primary-color);">
                            <i class="fas fa-home me-2"></i>
                            Back Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistics Section -->
    <section class="section-padding" data-aos="fade-up">
        <div class="modern-card">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="text-gradient">Project Statistics</h3>
                    <p class="text-muted">Built with modern web technologies</p>
                </div>
                <div class="row text-center">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number text-gradient">8+</div>
                            <div class="stat-label">PHP Version</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number text-gradient">100%</div>
                            <div class="stat-label">Responsive</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number text-gradient">5</div>
                            <div class="stat-label">Bootstrap</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-number text-gradient">MVC</div>
                            <div class="stat-label">Architecture</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.feature-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.tech-stack {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.tech-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.tech-item:hover {
    background: var(--gray-50);
    transform: translateX(5px);
}

.tech-item i {
    font-size: 1.25rem;
    width: 24px;
}

.info-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.info-item i {
    font-size: 1.25rem;
    width: 24px;
}

.stat-card {
    padding: 1.5rem 1rem;
    border-radius: var(--border-radius);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    background: var(--gray-50);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: var(--gray-600);
    font-weight: 500;
}

.text-purple {
    color: #764ba2 !important;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>