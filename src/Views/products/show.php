<?php ob_start(); ?>

<div class="product-detail-page">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" data-aos="fade-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/company/products">Products & Services</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($product['name']); ?></li>
            </ol>
        </nav>

        <!-- Product Header -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-lg-6">
                <div class="product-image-container">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                         alt="<?php echo htmlspecialchars($product['name']); ?>" 
                         class="product-image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-info">
                    <div class="product-category">
                        <i class="<?php echo htmlspecialchars($product['icon']); ?> me-2"></i>
                        <?php echo htmlspecialchars($product['category']); ?>
                    </div>
                    <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                    <p class="product-short-desc"><?php echo htmlspecialchars($product['short_description']); ?></p>
                    <div class="product-price">
                        <i class="fas fa-dollar-sign me-2"></i>
                        <strong>Investment Range:</strong> <?php echo htmlspecialchars($product['price']); ?>
                    </div>
                    <div class="product-actions mt-4">
                        <a href="/company/contacts" class="btn btn-primary btn-lg">
                            <i class="fas fa-phone me-2"></i>Request Quote
                        </a>
                        <a href="/company/products" class="btn btn-outline-secondary btn-lg ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up">
                <div class="product-section">
                    <h2><i class="fas fa-file-alt me-3"></i>Detailed Description</h2>
                    <p class="lead"><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="row mb-5">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="product-section">
                    <h2><i class="fas fa-check-circle me-3"></i>Key Features</h2>
                    <ul class="feature-list">
                        <?php foreach ($product['features'] as $feature): ?>
                        <li>
                            <i class="fas fa-check text-success me-2"></i>
                            <?php echo htmlspecialchars($feature); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="product-section">
                    <h2><i class="fas fa-code me-3"></i>Technologies Used</h2>
                    <div class="tech-badges">
                        <?php foreach ($product['technologies'] as $tech): ?>
                        <span class="badge bg-primary tech-badge">
                            <i class="fas fa-cog me-1"></i><?php echo htmlspecialchars($tech); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> We stay updated with the latest technologies and can adapt to your specific requirements.
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <?php if (!empty($related_products)): ?>
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="text-center mb-4">
                    <i class="fas fa-layer-group me-3"></i>Related Products & Services
                </h2>
            </div>
            <?php foreach ($related_products as $index => $related): ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="related-product-card">
                    <div class="related-product-icon">
                        <i class="<?php echo htmlspecialchars($related['icon']); ?>"></i>
                    </div>
                    <h4><?php echo htmlspecialchars($related['name']); ?></h4>
                    <p><?php echo htmlspecialchars($related['short_description']); ?></p>
                    <div class="related-product-price"><?php echo htmlspecialchars($related['price']); ?></div>
                    <a href="/products/show?id=<?php echo $related['id']; ?>" class="btn btn-outline-primary btn-sm mt-3">
                        <i class="fas fa-arrow-right me-2"></i>View Details
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Call to Action -->
        <div class="row" data-aos="fade-up">
            <div class="col-12">
                <div class="cta-box">
                    <h3><i class="fas fa-rocket me-3"></i>Ready to Get Started?</h3>
                    <p>Contact us today to discuss how this solution can benefit your business</p>
                    <div class="cta-buttons">
                        <a href="/company/contacts" class="btn btn-light btn-lg">
                            <i class="fas fa-envelope me-2"></i>Contact Sales
                        </a>
                        <a href="/products/recently-visited" class="btn btn-outline-light btn-lg ms-2">
                            <i class="fas fa-history me-2"></i>Recently Viewed
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-detail-page {
    padding-top: 100px;
    padding-bottom: 60px;
    background: linear-gradient(to bottom, #f7fafc 0%, #ffffff 100%);
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 30px;
}

.breadcrumb-item a {
    color: #667eea;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #764ba2;
    text-decoration: underline;
}

.product-image-container {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

.product-image {
    width: 100%;
    height: auto;
    display: block;
}

.product-info {
    padding: 20px 0;
}

.product-category {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 8px 20px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 20px;
}

.product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 20px;
    line-height: 1.2;
}

.product-short-desc {
    font-size: 1.2rem;
    color: #4a5568;
    margin-bottom: 25px;
}

.product-price {
    background: #f7fafc;
    padding: 15px 20px;
    border-radius: 10px;
    border-left: 4px solid #667eea;
    font-size: 1.1rem;
    color: #2d3748;
}

.product-section {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    height: 100%;
}

.product-section h2 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e2e8f0;
}

.feature-list {
    list-style: none;
    padding: 0;
}

.feature-list li {
    padding: 12px 0;
    font-size: 1.05rem;
    color: #4a5568;
    border-bottom: 1px solid #f7fafc;
}

.feature-list li:last-child {
    border-bottom: none;
}

.tech-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tech-badge {
    font-size: 0.95rem;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
}

.related-product-card {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.related-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.related-product-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 2rem;
    color: white;
}

.related-product-card h4 {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 15px;
}

.related-product-card p {
    color: #718096;
    font-size: 0.95rem;
    margin-bottom: 15px;
}

.related-product-price {
    color: #667eea;
    font-weight: 600;
    font-size: 1rem;
}

.cta-box {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 40px;
    border-radius: 16px;
    text-align: center;
    color: white;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
}

.cta-box h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-box p {
    font-size: 1.2rem;
    margin-bottom: 30px;
    opacity: 0.95;
}

.cta-buttons .btn {
    padding: 12px 30px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .product-title {
        font-size: 2rem;
    }
    
    .cta-box {
        padding: 40px 20px;
    }
    
    .cta-buttons .btn {
        display: block;
        width: 100%;
        margin: 10px 0 !important;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
