<?php ob_start(); ?>

<div class="recently-visited-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header text-center mb-5" data-aos="fade-up">
            <div class="icon-badge mx-auto mb-3">
                <i class="fas fa-history fa-3x"></i>
            </div>
            <h1>Recently Visited Products</h1>
            <p class="lead">Your last 5 viewed products & services</p>
        </div>

        <?php if (empty($products)): ?>
            <!-- Empty State -->
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-box-open fa-4x mb-3"></i>
                <h3>No Recently Visited Products</h3>
                <p>You haven't viewed any products yet. Browse our catalog to get started!</p>
                <a href="/company/products" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-th me-2"></i>Browse Products
                </a>
            </div>
        <?php else: ?>
            <!-- Products Grid -->
            <div class="row g-4 mb-5">
                <?php foreach ($products as $index => $product): ?>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="recent-product-card">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="product-image-wrapper">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                         class="recent-product-image">
                                    <div class="visit-badge">
                                        <i class="fas fa-eye me-1"></i>Visited
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="recent-product-body">
                                    <div class="product-category-small">
                                        <i class="<?php echo htmlspecialchars($product['icon']); ?> me-1"></i>
                                        <?php echo htmlspecialchars($product['category']); ?>
                                    </div>
                                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <p><?php echo htmlspecialchars($product['short_description']); ?></p>
                                    <div class="product-price-small">
                                        <i class="fas fa-dollar-sign me-1"></i>
                                        <?php echo htmlspecialchars($product['price']); ?>
                                    </div>
                                    <div class="product-actions-small">
                                        <a href="/products/show?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-right me-1"></i>View Again
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Info Box -->
            <div class="info-box" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4><i class="fas fa-cookie-bite me-2"></i>How Tracking Works</h4>
                        <p class="mb-0">
                            We use browser cookies to remember your last 5 visited products. 
                            This data is stored locally on your device and helps you quickly revisit products you're interested in.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="/products/most-visited" class="btn btn-outline-primary">
                            <i class="fas fa-fire me-2"></i>Most Visited
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Navigation -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="/company/products" class="btn btn-outline-secondary btn-lg me-2">
                <i class="fas fa-arrow-left me-2"></i>Back to Products
            </a>
            <a href="/products/most-visited" class="btn btn-primary btn-lg">
                <i class="fas fa-chart-line me-2"></i>View Most Visited
            </a>
        </div>
    </div>
</div>

<style>
.recently-visited-page {
    padding-top: 100px;
    padding-bottom: 60px;
    background: linear-gradient(to bottom, #f7fafc 0%, #ffffff 100%);
    min-height: 100vh;
}

.icon-badge {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
}

.page-header .lead {
    color: #718096;
    font-size: 1.2rem;
}

.empty-state {
    background: white;
    padding: 80px 40px;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.empty-state i {
    color: #cbd5e0;
}

.empty-state h3 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 15px;
}

.empty-state p {
    color: #718096;
    font-size: 1.1rem;
}

.recent-product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.recent-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.product-image-wrapper {
    position: relative;
    height: 100%;
    min-height: 250px;
}

.recent-product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.visit-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(102, 126, 234, 0.95);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.recent-product-body {
    padding: 25px;
}

.product-category-small {
    display: inline-block;
    background: #f7fafc;
    color: #667eea;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.recent-product-body h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 12px;
}

.recent-product-body p {
    color: #718096;
    font-size: 0.95rem;
    margin-bottom: 15px;
}

.product-price-small {
    color: #667eea;
    font-weight: 600;
    margin-bottom: 15px;
}

.info-box {
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    border: 2px solid #667eea30;
    padding: 30px;
    border-radius: 12px;
}

.info-box h4 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 10px;
}

.info-box p {
    color: #4a5568;
}

@media (max-width: 768px) {
    .product-image-wrapper {
        min-height: 200px;
    }
    
    .info-box {
        text-align: center;
    }
    
    .info-box .btn {
        margin-top: 20px;
        width: 100%;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
