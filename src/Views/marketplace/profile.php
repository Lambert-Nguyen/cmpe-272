<?php
require_once __DIR__ . '/../../Controllers/AuthController.php';
$currentUser = AuthController::getCurrentUser();
?>

<div class="container mt-4">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                             style="width: 100px; height: 100px; font-size: 2.5rem;">
                            <?= strtoupper(substr($user['username'], 0, 2)) ?>
                        </div>
                    </div>
                    <h4><?= htmlspecialchars($user['username']) ?></h4>
                    <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>
                    <small class="text-muted">Member since <?= date('M Y', strtotime($user['created_at'])) ?></small>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#reviews" class="list-group-item list-group-item-action">
                        My Reviews <span class="badge bg-primary float-end"><?= count($reviews) ?></span>
                    </a>
                    <a href="/marketplace/wishlist" class="list-group-item list-group-item-action">
                        Wishlist <span class="badge bg-danger float-end"><?= $wishlistCount ?></span>
                    </a>
                    <a href="#visit-history" class="list-group-item list-group-item-action">
                        Visit History <span class="badge bg-info float-end"><?= count($recentlyVisited) ?></span>
                    </a>
                </div>
                <div class="card-footer">
                    <a href="/logout" class="btn btn-outline-danger w-100">Logout</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-primary text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Reviews Written</h5>
                            <p class="display-4 mb-0"><?= count($reviews) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Wishlist Items</h5>
                            <p class="display-4 mb-0"><?= $wishlistCount ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Products Visited</h5>
                            <p class="display-4 mb-0"><?= count($recentlyVisited) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Reviews -->
            <div id="reviews" class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="mb-0">My Reviews</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($reviews)): ?>
                        <p class="text-muted">You haven't written any reviews yet.</p>
                        <a href="/marketplace" class="btn btn-primary">Start Exploring</a>
                    <?php else: ?>
                        <?php foreach ($reviews as $review): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h5 class="mb-1">
                                                <a href="/marketplace/product?id=<?= $review['product_id'] ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($review['product_name']) ?>
                                                </a>
                                            </h5>
                                            <small class="text-muted">
                                                <a href="/marketplace?company=<?= urlencode($review['company_url']) ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($review['company_name']) ?>
                                                </a>
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <div class="text-warning mb-1">
                                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>★<?php endfor; ?>
                                            </div>
                                            <small class="text-muted"><?= date('M d, Y', strtotime($review['created_at'])) ?></small>
                                        </div>
                                    </div>
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Visit History -->
            <div id="visit-history" class="card shadow-sm">
                <div class="card-header">
                    <h3 class="mb-0">Recently Visited Products</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($recentlyVisited)): ?>
                        <p class="text-muted">Your visit history is empty.</p>
                        <a href="/marketplace" class="btn btn-primary">Browse Products</a>
                    <?php else: ?>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                            <?php foreach ($recentlyVisited as $product): ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <span class="badge bg-secondary mb-2"><?= htmlspecialchars($product['category']) ?></span>
                                            <span class="badge bg-info mb-2"><?= htmlspecialchars($product['company_name']) ?></span>
                                            <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>

                                            <div class="mb-2">
                                                <div class="text-warning small">
                                                    <?php
                                                    $avgRating = round($product['avg_rating'], 1);
                                                    for ($i = 0; $i < floor($avgRating); $i++): ?>★<?php endfor;
                                                    ?>
                                                    <span class="text-muted">(<?= $product['review_count'] ?>)</span>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-primary fw-bold">${= number_format($product['price'], 2) ?></span>
                                                <small class="text-muted">
                                                    <?= date('M d', strtotime($product['last_visited'])) ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <a href="/marketplace/product?id=<?= $product['id'] ?>" class="btn btn-sm btn-primary w-100">
                                                View Again
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-4">
                <a href="/marketplace" class="btn btn-primary">Back to Marketplace</a>
                <a href="/marketplace/wishlist" class="btn btn-outline-danger">View Wishlist</a>
            </div>
        </div>
    </div>
</div>
