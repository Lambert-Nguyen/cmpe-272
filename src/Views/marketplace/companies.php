<div class="container mt-4">
    <h1 class="mb-4">All Companies in Marketplace</h1>
    <p class="lead mb-4">Explore products and services from <?= count($companyStats) ?> partner companies</p>

    <?php if (empty($companyStats)): ?>
        <div class="alert alert-info">No companies found in the marketplace.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($companyStats as $companyName => $stats): ?>
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0"><?= htmlspecialchars($companyName) ?></h3>
                                <div>
                                    <span class="badge bg-light text-dark me-2"><?= $stats['product_count'] ?> Products</span>
                                    <a href="<?= htmlspecialchars($stats['company_url']) ?>" target="_blank" class="btn btn-sm btn-light">
                                        Visit Website
                                    </a>
                                    <a href="/marketplace/company-top5" class="btn btn-sm btn-outline-light">
                                        View Top Products
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (empty($stats['products'])): ?>
                                <p class="text-muted mb-0">No products available from this company yet.</p>
                            <?php else: ?>
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
                                    <?php
                                    // Show first 4 products
                                    $displayProducts = array_slice($stats['products'], 0, 4);
                                    foreach ($displayProducts as $product):
                                    ?>
                                        <div class="col">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <span class="badge bg-secondary mb-2"><?= htmlspecialchars($product['category']) ?></span>
                                                    <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>

                                                    <!-- Rating -->
                                                    <div class="mb-2">
                                                        <span class="text-warning small">
                                                            <?php
                                                            $avgRating = round($product['avg_rating'], 1);
                                                            for ($i = 0; $i < floor($avgRating); $i++): ?>★<?php endfor;
                                                            ?>
                                                        </span>
                                                        <small class="text-muted">
                                                            (<?= $product['review_count'] ?>)
                                                        </small>
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="text-primary fw-bold">${= number_format($product['price'], 2) ?></span>
                                                        <small class="text-muted"><?= $product['visit_count'] ?> visits</small>
                                                    </div>
                                                </div>
                                                <div class="card-footer bg-transparent">
                                                    <a href="/marketplace/product?id=<?= $product['id'] ?>" class="btn btn-sm btn-primary w-100">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if ($stats['product_count'] > 4): ?>
                                    <div class="mt-3 text-center">
                                        <a href="/marketplace?company=<?= urlencode($stats['company_url']) ?>" class="btn btn-outline-primary">
                                            View All <?= $stats['product_count'] ?> Products
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="/marketplace" class="btn btn-primary">Back to Marketplace</a>
        <a href="/marketplace/top5" class="btn btn-outline-primary">View Top 5 Products</a>
    </div>
</div>
