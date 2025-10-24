<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <section class="page-header" data-aos="fade-up">
        <div class="text-center">
            <h1 class="page-title">Products & Services</h1>
            <p class="page-subtitle">Comprehensive technology solutions designed to accelerate your business growth</p>
            
            <!-- Tracking Links -->
            <div class="tracking-links mt-4">
                <a href="/products/recently-visited" class="btn btn-outline-primary me-2">
                    <i class="fas fa-history me-2"></i>Recently Visited (Last 5)
                </a>
                <a href="/products/most-visited" class="btn btn-outline-warning">
                    <i class="fas fa-fire me-2"></i>Most Visited (Top 5)
                </a>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="section-padding">
        <div class="row g-4">
            <?php foreach ($products as $index => $product): ?>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo $index * 50; ?>">
                <div class="product-card">
                    <div class="product-image-section">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>"
                             class="product-card-image">
                        <div class="product-overlay">
                            <a href="/products/show?id=<?php echo $product['id']; ?>" class="btn btn-light btn-lg">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        </div>
                    </div>
                    <div class="product-card-body">
                        <div class="product-category-badge">
                            <i class="<?php echo htmlspecialchars($product['icon']); ?> me-2"></i>
                            <?php echo htmlspecialchars($product['category']); ?>
                        </div>
                        <h3 class="product-card-title">
                            <a href="/products/show?id=<?php echo $product['id']; ?>">
                                <?php echo htmlspecialchars($product['name']); ?>
                            </a>
                        </h3>
                        <p class="product-card-desc"><?php echo htmlspecialchars($product['short_description']); ?></p>
                        <div class="product-card-footer">
                            <div class="product-price">
                                <i class="fas fa-dollar-sign me-1"></i>
                                <?php echo htmlspecialchars($product['price']); ?>
                            </div>
                            <a href="/products/show?id=<?php echo $product['id']; ?>" class="btn btn-primary">
                                Learn More <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
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
                    <i class="fas fa-info-circle me-2"></i>
                    Learn More About Us
                </a>
            </div>
        </div>
    </section>
</div>

<style>
.tracking-links {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.product-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.product-image-section {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.product-card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.product-card:hover .product-card-image {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(102, 126, 234, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-category-badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    color: #667eea;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
    width: fit-content;
}

.product-card-title {
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 15px;
    line-height: 1.3;
}

.product-card-title a {
    color: #2d3748;
    text-decoration: none;
    transition: color 0.3s ease;
}

.product-card-title a:hover {
    color: #667eea;
}

.product-card-desc {
    color: #718096;
    font-size: 0.95rem;
    margin-bottom: 20px;
    flex: 1;
}

.product-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 2px solid #f7fafc;
}

.product-price {
    color: #667eea;
    font-weight: 600;
    font-size: 0.95rem;
}

@media (max-width: 768px) {
    .product-card-footer {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .product-card-footer .btn {
        width: 100%;
    }
    
    .tracking-links {
        flex-direction: column;
    }
    
    .tracking-links .btn {
        width: 100%;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>