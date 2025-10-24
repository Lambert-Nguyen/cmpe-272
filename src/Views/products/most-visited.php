<?php ob_start(); ?>

<div class="most-visited-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header text-center mb-5" data-aos="fade-up">
            <div class="icon-badge mx-auto mb-3">
                <i class="fas fa-fire fa-3x"></i>
            </div>
            <h1>Most Visited Products</h1>
            <p class="lead">Your top 5 most frequently viewed products & services</p>
            <div class="badge bg-warning text-dark mt-2">
                <i class="fas fa-star me-1"></i>Extra Credit Feature
            </div>
        </div>

        <?php if (empty($products)): ?>
            <!-- Empty State -->
            <div class="empty-state" data-aos="fade-up">
                <i class="fas fa-chart-line fa-4x mb-3"></i>
                <h3>No Visit Data Available</h3>
                <p>Start exploring our products to see your most visited items here!</p>
                <a href="/company/products" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-th me-2"></i>Browse Products
                </a>
            </div>
        <?php else: ?>
            <!-- Products Grid with Rankings -->
            <div class="row g-4 mb-5">
                <?php foreach ($products as $index => $product): ?>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    <div class="most-visited-card">
                        <div class="rank-badge rank-<?php echo $index + 1; ?>">
                            <span class="rank-number">#<?php echo $index + 1; ?></span>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="product-image-wrapper">
                                    <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                         class="most-visited-image">
                                    <div class="visit-count-badge">
                                        <i class="fas fa-eye me-1"></i>
                                        <?php echo $product['visit_count']; ?> visit<?php echo $product['visit_count'] > 1 ? 's' : ''; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="most-visited-body">
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
                                    <div class="visit-stats">
                                        <div class="progress">
                                            <div class="progress-bar bg-gradient" 
                                                 role="progressbar" 
                                                 style="width: <?php echo min(100, ($product['visit_count'] / max(1, $products[0]['visit_count'])) * 100); ?>%"
                                                 aria-valuenow="<?php echo $product['visit_count']; ?>" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="<?php echo $products[0]['visit_count']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-actions-small">
                                        <a href="/products/show?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-arrow-right me-1"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Stats Summary -->
            <div class="stats-summary" data-aos="fade-up">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="stat-item">
                            <i class="fas fa-eye fa-2x mb-2"></i>
                            <h3><?php echo array_sum(array_column($products, 'visit_count')); ?></h3>
                            <p>Total Visits</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-item">
                            <i class="fas fa-trophy fa-2x mb-2"></i>
                            <h3><?php echo $products[0]['visit_count']; ?></h3>
                            <p>Top Product Visits</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-item">
                            <i class="fas fa-chart-bar fa-2x mb-2"></i>
                            <h3><?php echo count($products); ?></h3>
                            <p>Products Tracked</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="info-box" data-aos="fade-up">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4><i class="fas fa-info-circle me-2"></i>How Visit Counting Works</h4>
                        <p class="mb-0">
                            Each time you view a product, we increment its visit counter using browser cookies. 
                            This helps us show you which products interest you the most. The counter resets if you clear your cookies.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="/products/recently-visited" class="btn btn-outline-primary">
                            <i class="fas fa-history me-2"></i>Recently Visited
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
            <a href="/products/recently-visited" class="btn btn-primary btn-lg">
                <i class="fas fa-clock me-2"></i>Recently Visited
            </a>
        </div>
    </div>
</div>

<style>
.most-visited-page {
    padding-top: 100px;
    padding-bottom: 60px;
    background: linear-gradient(to bottom, #fff5e6 0%, #ffffff 100%);
    min-height: 100vh;
}

.icon-badge {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #ff9a56 0%, #ff6b6b 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
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
    color: #ffd166;
}

.most-visited-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
}

.most-visited-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.rank-badge {
    position: absolute;
    top: -10px;
    left: -10px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.rank-badge.rank-1 {
    background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
}

.rank-badge.rank-2 {
    background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%);
}

.rank-badge.rank-3 {
    background: linear-gradient(135deg, #cd7f32 0%, #e8a57c 100%);
}

.rank-badge.rank-4,
.rank-badge.rank-5 {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.rank-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.product-image-wrapper {
    position: relative;
    height: 100%;
    min-height: 250px;
}

.most-visited-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.visit-count-badge {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: rgba(255, 107, 107, 0.95);
    color: white;
    padding: 8px 15px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.most-visited-body {
    padding: 25px;
}

.product-category-small {
    display: inline-block;
    background: #fff5e6;
    color: #ff9a56;
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.most-visited-body h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 12px;
}

.most-visited-body p {
    color: #718096;
    font-size: 0.95rem;
    margin-bottom: 15px;
}

.product-price-small {
    color: #ff9a56;
    font-weight: 600;
    margin-bottom: 15px;
}

.visit-stats {
    margin-bottom: 15px;
}

.progress {
    height: 8px;
    background: #f7fafc;
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar.bg-gradient {
    background: linear-gradient(90deg, #ff9a56 0%, #ff6b6b 100%);
}

.stats-summary {
    background: white;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
}

.stat-item i {
    color: #ff9a56;
}

.stat-item h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin: 10px 0 5px;
}

.stat-item p {
    color: #718096;
    margin: 0;
}

.info-box {
    background: linear-gradient(135deg, #ff9a5615 0%, #ff6b6b15 100%);
    border: 2px solid #ff9a5630;
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
