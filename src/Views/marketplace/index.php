<?php
require_once __DIR__ . '/../../Controllers/AuthController.php';
$currentUser = AuthController::getCurrentUser();
$isLoggedIn = AuthController::isLoggedIn();
?>

<div class="container-fluid mt-4">
    <!-- Hero Section -->
    <div class="bg-primary text-white rounded-3 p-5 mb-4">
        <h1 class="display-4 fw-bold">Cross Domain Enterprise Marketplace</h1>
        <p class="lead">Discover products and services from <?= count($companies) ?> partner companies</p>
    </div>

    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="/marketplace">
                        <!-- Search -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Search</label>
                            <input type="text" class="form-control" name="search" placeholder="Search products..."
                                   value="<?= htmlspecialchars($filters['search'] ?? '') ?>">
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select class="form-select" name="category">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>"
                                        <?= isset($filters['category']) && $filters['category'] == $cat ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Company Filter -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Company</label>
                            <select class="form-select" name="company">
                                <option value="">All Companies</option>
                                <?php foreach ($companies as $comp): ?>
                                    <option value="<?= htmlspecialchars($comp['company_url']) ?>"
                                        <?= isset($filters['company_url']) && $filters['company_url'] == $comp['company_url'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($comp['company_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Price Range</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" class="form-control" name="price_min" placeholder="Min"
                                           value="<?= htmlspecialchars($filters['price_min'] ?? '') ?>">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" name="price_max" placeholder="Max"
                                           value="<?= htmlspecialchars($filters['price_max'] ?? '') ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Minimum Rating -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Minimum Rating</label>
                            <select class="form-select" name="min_rating">
                                <option value="">Any Rating</option>
                                <option value="4" <?= isset($filters['min_rating']) && $filters['min_rating'] == '4' ? 'selected' : '' ?>>4+ Stars</option>
                                <option value="3" <?= isset($filters['min_rating']) && $filters['min_rating'] == '3' ? 'selected' : '' ?>>3+ Stars</option>
                                <option value="2" <?= isset($filters['min_rating']) && $filters['min_rating'] == '2' ? 'selected' : '' ?>>2+ Stars</option>
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sort By</label>
                            <select class="form-select" name="sort">
                                <option value="created_at" <?= $currentSort == 'created_at' ? 'selected' : '' ?>>Newest First</option>
                                <option value="visits" <?= $currentSort == 'visits' ? 'selected' : '' ?>>Most Visited</option>
                                <option value="rating" <?= $currentSort == 'rating' ? 'selected' : '' ?>>Highest Rated</option>
                                <option value="price_asc" <?= $currentSort == 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>
                                <option value="price_desc" <?= $currentSort == 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>
                                <option value="name" <?= $currentSort == 'name' ? 'selected' : '' ?>>Name A-Z</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="/marketplace" class="btn btn-outline-secondary w-100 mt-2">Clear All</a>
                    </form>
                </div>
            </div>

            <!-- Top 5 Marketplace-Wide -->
            <?php if (!empty($topProducts)): ?>
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Top 5 Products</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php foreach ($topProducts as $top): ?>
                            <a href="/marketplace/product?id=<?= $top['id'] ?>" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1"><?= htmlspecialchars(substr($top['name'], 0, 30)) ?></h6>
                                    <small class="text-muted"><?= $top['visit_count'] ?> visits</small>
                                </div>
                                <small class="text-muted"><?= htmlspecialchars($top['company_name']) ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer">
                        <a href="/marketplace/top5" class="btn btn-sm btn-outline-primary w-100">View All Top Products</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>All Products (<?= count($products) ?>)</h2>
                <div>
                    <a href="/marketplace/companies" class="btn btn-outline-primary">Browse by Company</a>
                    <a href="/marketplace/company-top5" class="btn btn-outline-success">Company Rankings</a>
                </div>
            </div>

            <?php if (empty($products)): ?>
                <div class="alert alert-info">
                    No products found matching your criteria. Try adjusting your filters.
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-secondary"><?= htmlspecialchars($product['category']) ?></span>
                                        <span class="badge bg-info"><?= htmlspecialchars($product['company_name']) ?></span>
                                    </div>

                                    <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                                    <p class="card-text text-muted small">
                                        <?= htmlspecialchars(substr($product['description'], 0, 100)) ?>...
                                    </p>

                                    <!-- Rating Display -->
                                    <div class="mb-2">
                                        <?php
                                        $avgRating = round($product['avg_rating'], 1);
                                        $fullStars = floor($avgRating);
                                        $halfStar = ($avgRating - $fullStars) >= 0.5;
                                        ?>
                                        <div class="text-warning">
                                            <?php for ($i = 0; $i < $fullStars; $i++): ?>★<?php endfor; ?>
                                            <?php if ($halfStar): ?>☆<?php endif; ?>
                                            <?php for ($i = 0; $i < (5 - $fullStars - ($halfStar ? 1 : 0)); $i++): ?>☆<?php endfor; ?>
                                            <small class="text-muted">(<?= $product['review_count'] ?> reviews)</small>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h5 mb-0 text-primary">$<?= number_format($product['price'], 2) ?></span>
                                        <small class="text-muted"><?= $product['visit_count'] ?> visits</small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="/marketplace/product?id=<?= $product['id'] ?>" class="btn btn-primary w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Reviews Section -->
    <?php if (!empty($recentReviews)): ?>
        <div class="mt-5">
            <h3>Recent Reviews</h3>
            <div class="row">
                <?php foreach ($recentReviews as $review): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong><?= htmlspecialchars($review['username']) ?></strong>
                                    <span class="text-warning">
                                        <?php for ($i = 0; $i < $review['rating']; $i++): ?>★<?php endfor; ?>
                                    </span>
                                </div>
                                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($review['product_name']) ?></h6>
                                <p class="card-text small"><?= htmlspecialchars(substr($review['comment'], 0, 100)) ?>...</p>
                                <small class="text-muted"><?= htmlspecialchars($review['company_name']) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
