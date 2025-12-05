<?php ob_start(); ?>

<div class="container">
    <!-- Hero Section -->
    <section class="hero-section company-hero" data-aos="fade-up">
        <div class="hero-content text-center">
            <h1 class="hero-title"><?php echo htmlspecialchars($company_name); ?></h1>
            <p class="hero-subtitle"><?php echo htmlspecialchars($tagline); ?></p>
            <div class="hero-description">
                <p><?php echo htmlspecialchars($description); ?></p>
            </div>
            
            <!-- Hero Features -->
            <div class="hero-features mt-4">
                <div class="row g-3">
                    <?php foreach ($hero_features as $feature): ?>
                    <div class="col-md-6">
                        <div class="feature-badge">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo htmlspecialchars($feature); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="hero-buttons">
                <a href="/company/products" class="btn-modern btn-modern-primary">
                    <i class="fas fa-rocket"></i>
                    Our Services
                </a>
                <a href="/company/about" class="btn-modern btn-modern-outline">
                    <i class="fas fa-info-circle"></i>
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="section-padding">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our Expertise</h2>
            <p class="section-subtitle">Comprehensive technology solutions tailored to your business needs</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Software Development</h3>
                    <p>Custom applications built with modern technologies and best practices for scalability and performance.</p>
                    <a href="/company/products" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>Cloud Solutions</h3>
                    <p>Seamless migration and optimization of your infrastructure for the cloud era.</p>
                    <a href="/company/products" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3>AI & Analytics</h3>
                    <p>Intelligent automation and data-driven insights to transform your business operations.</p>
                    <a href="/company/products" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section-padding bg-light">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Why Choose Lambert Engineering & Business Solutions?</h2>
            <p class="section-subtitle">Your trusted partner in digital transformation</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-item text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-award"></i>
                    </div>
                    <h4>Proven Excellence</h4>
                    <p>5+ years of delivering exceptional technology solutions</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-item text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Expert Team</h4>
                    <p>25+ skilled professionals with diverse expertise</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-item text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4>Client-Focused</h4>
                    <p>150+ satisfied clients across various industries</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-item text-center">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>On-Time Delivery</h4>
                    <p>300+ projects completed successfully and on schedule</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding">
        <div class="cta-section text-center" data-aos="fade-up">
            <h2>Ready to Transform Your Business?</h2>
            <p class="lead">Let's discuss how we can help you achieve your technology goals</p>
            <div class="cta-buttons">
                <a href="/company/contacts" class="btn-modern btn-modern-primary">
                    <i class="fas fa-phone"></i>
                    Get In Touch
                </a>
                <a href="/company/news" class="btn-modern btn-modern-outline">
                    <i class="fas fa-newspaper"></i>
                    Latest News
                </a>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>