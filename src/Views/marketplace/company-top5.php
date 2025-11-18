<div class="container mt-4">
    <h1 class="mb-4">Top 5 Products by Company</h1>
    <p class="lead mb-4">Explore the most visited products from each company in our marketplace.</p>

    <?php if (empty($topProductsByCompany)): ?>
        <div class="alert alert-info">No companies or products found.</div>
    <?php else: ?>
        <?php foreach ($topProductsByCompany as $companyName => $data): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><?= htmlspecialchars($companyName) ?></h3>
                        <div>
                            <a href="<?= htmlspecialchars($data['company_url']) ?>" target="_blank" class="btn btn-sm btn-light">
                                Visit Website
                            </a>
                            <a href="/marketplace?company=<?= urlencode($data['company_url']) ?>" class="btn btn-sm btn-outline-light">
                                View All Products
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (empty($data['products'])): ?>
                        <p class="text-muted mb-0">No products available from this company yet.</p>
                    <?php else: ?>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            <?php foreach ($data['products'] as $index => $product): ?>
                                <div class="col">
                                    <div class="card h-100 border-info">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="badge bg-info">#<?= $index + 1 ?></span>
                                                <span class="badge bg-secondary"><?= htmlspecialchars($product['category']) ?></span>
                                            </div>
                                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>

                                            <!-- Rating -->
                                            <div class="mb-2">
                                                <span class="text-warning">
                                                    <?php
                                                    $avgRating = round($product['avg_rating'], 1);
                                                    for ($i = 0; $i < floor($avgRating); $i++): ?>★<?php endfor;
                                                    ?>
                                                </span>
                                                <small class="text-muted">
                                                    <?= $avgRating ?> (<?= $product['review_count'] ?> reviews)
                                                </small>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="h5 mb-0 text-primary">${= number_format($product['price'], 2) ?></span>
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
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="mt-4">
        <a href="/marketplace" class="btn btn-primary">Back to Marketplace</a>
        <a href="/marketplace/top5" class="btn btn-outline-primary">View Marketplace Top 5</a>
    </div>
</div>
