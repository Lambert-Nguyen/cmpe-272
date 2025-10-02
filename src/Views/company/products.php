<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <section class="page-header" data-aos="fade-up">
        <div class="text-center">
            <h1 class="page-title">Products & Services</h1>
            <p class="page-subtitle">Comprehensive technology solutions designed to accelerate your business growth</p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="section-padding">
        <div class="row g-4">
            <?php foreach ($services as $index => $service): ?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="service-detail-card">
                    <div class="service-header">
                        <div class="service-icon-large">
                            <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
                        </div>
                        <div class="service-title-section">
                            <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                            <div class="service-price"><?php echo htmlspecialchars($service['price_range']); ?></div>
                        </div>
                    </div>
                    
                    <div class="service-body">
                        <p><?php echo htmlspecialchars($service['description']); ?></p>
                        
                        <h5>Key Features:</h5>
                        <ul class="service-features">
                            <?php foreach ($service['features'] as $feature): ?>
                            <li><i class="fas fa-check text-success me-2"></i><?php echo htmlspecialchars($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <div class="service-footer">
                        <a href="/company/contacts" class="btn btn-primary">
                            <i class="fas fa-phone me-2"></i>Get Quote
                        </a>
                        <a href="#" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-info-circle me-2"></i>Learn More
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Process Section -->
    <section class="section-padding bg-light">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our Development Process</h2>
            <p class="section-subtitle">How we deliver exceptional results every time</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="process-step text-center">
                    <div class="process-number">1</div>
                    <h4>Discovery</h4>
                    <p>We analyze your requirements and understand your business goals</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="process-step text-center">
                    <div class="process-number">2</div>
                    <h4>Planning</h4>
                    <p>We create detailed project roadmaps and technical specifications</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="process-step text-center">
                    <div class="process-number">3</div>
                    <h4>Development</h4>
                    <p>Our expert team builds your solution using best practices</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="process-step text-center">
                    <div class="process-number">4</div>
                    <h4>Delivery</h4>
                    <p>We deploy and support your solution with ongoing maintenance</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies -->
    <section class="section-padding">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Technologies We Use</h2>
            <p class="section-subtitle">Cutting-edge tools and frameworks for modern solutions</p>
        </div>
        
        <div class="row g-4 text-center">
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="tech-item">
                    <i class="fab fa-php fa-3x text-primary"></i>
                    <h5>PHP</h5>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                <div class="tech-item">
                    <i class="fab fa-js-square fa-3x text-warning"></i>
                    <h5>JavaScript</h5>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="tech-item">
                    <i class="fab fa-python fa-3x text-info"></i>
                    <h5>Python</h5>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250">
                <div class="tech-item">
                    <i class="fab fa-java fa-3x text-danger"></i>
                    <h5>Java</h5>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="tech-item">
                    <i class="fab fa-aws fa-3x text-dark"></i>
                    <h5>AWS</h5>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <div class="tech-item">
                    <i class="fab fa-docker fa-3x text-primary"></i>
                    <h5>Docker</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="section-padding bg-primary text-white">
        <div class="cta-section text-center" data-aos="fade-up">
            <h2 class="text-white">Ready to Get Started?</h2>
            <p class="lead text-light">Contact us today for a free consultation and project estimate</p>
            <div class="cta-buttons">
                <a href="/company/contacts" class="btn btn-light btn-lg">
                    <i class="fas fa-phone me-2"></i>
                    Contact Us Today
                </a>
                <a href="/company/about" class="btn btn-outline-light btn-lg ms-3">
                    <i class="fas fa-users me-2"></i>
                    Meet Our Team
                </a>
            </div>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>