<div class="container mt-4">
    <h1 class="mb-4">Top 5 Products - Marketplace Wide</h1>

    <div class="row">
        <!-- Top by Visits -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Most Visited Products</h3>
                </div>
                <div class="list-group list-group-flush">
                    <?php if (empty($topByVisits)): ?>
                        <div class="list-group-item">No data available</div>
                    <?php else: ?>
                        <?php foreach ($topByVisits as $index => $product): ?>
                            <a href="/marketplace/product?id=<?= $product['id'] ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="badge bg-primary rounded-circle me-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                                #<?= $index + 1 ?>
                                            </span>
                                            <h5 class="mb-0"><?= htmlspecialchars($product['name']) ?></h5>
                                        </div>
                                        <p class="mb-1 text-muted small"><?= htmlspecialchars($product['company_name']) ?></p>
                                        <div class="d-flex gap-3">
                                            <small class="text-muted">
                                                <strong><?= $product['visit_count'] ?></strong> visits
                                            </small>
                                            <small class="text-warning">
                                                ★ <?= round($product['avg_rating'], 1) ?> (<?= $product['review_count'] ?> reviews)
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="h5 text-primary">${= number_format($product['price'], 2) ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Top by Rating -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">Highest Rated Products</h3>
                </div>
                <div class="list-group list-group-flush">
                    <?php if (empty($topByRating)): ?>
                        <div class="list-group-item">No rated products yet</div>
                    <?php else: ?>
                        <?php foreach ($topByRating as $index => $product): ?>
                            <a href="/marketplace/product?id=<?= $product['id'] ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="badge bg-warning text-dark rounded-circle me-2" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                                #<?= $index + 1 ?>
                                            </span>
                                            <h5 class="mb-0"><?= htmlspecialchars($product['name']) ?></h5>
                                        </div>
                                        <p class="mb-1 text-muted small"><?= htmlspecialchars($product['company_name']) ?></p>
                                        <div class="d-flex gap-3">
                                            <small class="text-warning">
                                                <strong>★ <?= round($product['avg_rating'], 1) ?></strong> (<?= $product['review_count'] ?> reviews)
                                            </small>
                                            <small class="text-muted">
                                                <?= $product['visit_count'] ?> visits
                                            </small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="h5 text-primary">${= number_format($product['price'], 2) ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="/marketplace" class="btn btn-primary">Back to Marketplace</a>
        <a href="/marketplace/company-top5" class="btn btn-outline-primary">View Top Products by Company</a>
    </div>
</div>
