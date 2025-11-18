<?php
require_once __DIR__ . '/../../Controllers/AuthController.php';
$currentUser = AuthController::getCurrentUser();
?>

<div class="container mt-4">
    <h1 class="mb-4">My Wishlist</h1>

    <?php if (empty($wishlistItems)): ?>
        <div class="alert alert-info">
            <h4>Your wishlist is empty</h4>
            <p>Start exploring the marketplace and add products you love!</p>
            <a href="/marketplace" class="btn btn-primary">Browse Products</a>
        </div>
    <?php else: ?>
        <p class="lead mb-4">You have <?= count($wishlistItems) ?> items in your wishlist</p>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($wishlistItems as $item): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-secondary"><?= htmlspecialchars($item['category']) ?></span>
                                <form method="POST" action="/marketplace/wishlist/toggle" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Remove from wishlist">
                                        ❤
                                    </button>
                                </form>
                            </div>

                            <span class="badge bg-info mb-2"><?= htmlspecialchars($item['company_name']) ?></span>

                            <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                            <p class="card-text text-muted small">
                                <?= htmlspecialchars(substr($item['description'], 0, 100)) ?>...
                            </p>

                            <!-- Rating Display -->
                            <div class="mb-2">
                                <?php
                                $avgRating = round($item['avg_rating'], 1);
                                $fullStars = floor($avgRating);
                                ?>
                                <div class="text-warning">
                                    <?php for ($i = 0; $i < $fullStars; $i++): ?>★<?php endfor; ?>
                                    <?php for ($i = 0; $i < (5 - $fullStars); $i++): ?>☆<?php endfor; ?>
                                    <small class="text-muted">(<?= $item['review_count'] ?> reviews)</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 mb-0 text-primary">${= number_format($item['price'], 2) ?></span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="/marketplace/product?id=<?= $item['product_id'] ?>" class="btn btn-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-4">
            <a href="/marketplace" class="btn btn-primary">Continue Shopping</a>
            <a href="/profile" class="btn btn-outline-secondary">View Profile</a>
        </div>
    <?php endif; ?>
</div>
