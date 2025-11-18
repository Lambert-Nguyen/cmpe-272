<?php
require_once __DIR__ . '/../../Controllers/AuthController.php';
$currentUser = AuthController::getCurrentUser();
$isLoggedIn = AuthController::isLoggedIn();
$avgRating = round($product['avg_rating'], 1);
?>

<div class="container mt-4">
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

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/marketplace">Marketplace</a></li>
            <li class="breadcrumb-item"><a href="/marketplace?company=<?= urlencode($product['company_url']) ?>"><?= htmlspecialchars($product['company_name']) ?></a></li>
            <li class="breadcrumb-item active"><?= htmlspecialchars($product['name']) ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Info -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h2"><?= htmlspecialchars($product['name']) ?></h1>
                            <p class="text-muted mb-2">
                                <a href="/marketplace?company=<?= urlencode($product['company_url']) ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($product['company_name']) ?>
                                </a>
                                |
                                <span class="badge bg-secondary"><?= htmlspecialchars($product['category']) ?></span>
                            </p>
                        </div>
                        <?php if ($isLoggedIn): ?>
                            <form method="POST" action="/marketplace/wishlist/toggle" id="wishlistForm" class="d-inline">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-outline-danger">
                                    <?= $inWishlist ? '❤ Remove from Wishlist' : '♡ Add to Wishlist' ?>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <!-- Rating Summary -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning me-2" style="font-size: 1.5rem;">
                            <?php for ($i = 0; $i < floor($avgRating); $i++): ?>★<?php endfor; ?>
                            <?php if (($avgRating - floor($avgRating)) >= 0.5): ?>☆<?php endif; ?>
                            <?php for ($i = 0; $i < (5 - floor($avgRating) - (($avgRating - floor($avgRating)) >= 0.5 ? 1 : 0)); $i++): ?>☆<?php endfor; ?>
                        </div>
                        <div>
                            <strong><?= $avgRating ?></strong> out of 5
                            <span class="text-muted">(<?= $product['review_count'] ?> reviews)</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <span class="h3 text-primary">${= number_format($product['price'], 2) ?></span>
                        <span class="text-muted ms-2"><?= $product['visit_count'] ?> visits</span>
                    </div>

                    <div class="mb-4">
                        <h4>Description</h4>
                        <p class="lead"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                    </div>

                    <div class="mb-3">
                        <a href="<?= htmlspecialchars($product['company_url']) ?>" target="_blank" class="btn btn-primary btn-lg">
                            Visit Company Website
                        </a>
                    </div>
                </div>
            </div>

            <!-- Rating Breakdown -->
            <?php if ($product['review_count'] > 0): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4>Rating Breakdown</h4>
                        <?php foreach ([5, 4, 3, 2, 1] as $star): ?>
                            <div class="row align-items-center mb-2">
                                <div class="col-3 col-md-2">
                                    <span class="text-warning"><?php for ($i = 0; $i < $star; $i++): ?>★<?php endfor; ?></span>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="progress">
                                        <div class="progress-bar bg-warning"
                                             style="width: <?= $ratingStats["{$star}_star_pct"] ?>%"></div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <small class="text-muted"><?= $ratingStats["{$star}_star"] ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Reviews Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Customer Reviews</h4>
                </div>
                <div class="card-body">
                    <?php if (!$isLoggedIn): ?>
                        <div class="alert alert-info">
                            Please <a href="/login?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>">login</a> to write a review.
                        </div>
                    <?php elseif (!$userReview): ?>
                        <!-- Review Form -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5>Write a Review</h5>
                                <form method="POST" action="/marketplace/review/submit">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <div class="btn-group" role="group">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <input type="radio" class="btn-check" name="rating" id="rating<?= $i ?>" value="<?= $i ?>" required>
                                                <label class="btn btn-outline-warning" for="rating<?= $i ?>"><?= $i ?> ★</label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Your Review</label>
                                        <textarea class="form-control" name="comment" rows="4" required
                                                  placeholder="Share your experience with this product..."></textarea>
                                        <small class="form-text text-muted">Minimum 10 characters</small>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- User's Existing Review -->
                        <div class="card border-primary mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <strong>Your Review</strong>
                                        <div class="text-warning">
                                            <?php for ($i = 0; $i < $userReview['rating']; $i++): ?>★<?php endfor; ?>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#editReviewForm">
                                            Edit
                                        </button>
                                        <form method="POST" action="/marketplace/review/delete" class="d-inline">
                                            <input type="hidden" name="review_id" value="<?= $userReview['id'] ?>">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Delete your review?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <p><?= nl2br(htmlspecialchars($userReview['comment'])) ?></p>
                                <small class="text-muted">Posted on <?= date('M d, Y', strtotime($userReview['created_at'])) ?></small>

                                <!-- Edit Form (Collapsed) -->
                                <div class="collapse mt-3" id="editReviewForm">
                                    <hr>
                                    <form method="POST" action="/marketplace/review/update">
                                        <input type="hidden" name="review_id" value="<?= $userReview['id'] ?>">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <div class="btn-group" role="group">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <input type="radio" class="btn-check" name="rating" id="edit_rating<?= $i ?>" value="<?= $i ?>"
                                                        <?= $userReview['rating'] == $i ? 'checked' : '' ?> required>
                                                    <label class="btn btn-outline-warning" for="edit_rating<?= $i ?>"><?= $i ?> ★</label>
                                                <?php endfor; ?>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Your Review</label>
                                            <textarea class="form-control" name="comment" rows="4" required><?= htmlspecialchars($userReview['comment']) ?></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Review</button>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#editReviewForm">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- All Reviews -->
                    <?php if (empty($reviews)): ?>
                        <p class="text-muted">No reviews yet. Be the first to review!</p>
                    <?php else: ?>
                        <h5 class="mt-4 mb-3">All Reviews (<?= count($reviews) ?>)</h5>
                        <?php foreach ($reviews as $review): ?>
                            <?php if ($isLoggedIn && $review['user_id'] == $currentUser['id']) continue; // Skip user's own review ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <strong><?= htmlspecialchars($review['username']) ?></strong>
                                            <div class="text-warning">
                                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>★<?php endfor; ?>
                                            </div>
                                        </div>
                                        <small class="text-muted"><?= date('M d, Y', strtotime($review['created_at'])) ?></small>
                                    </div>
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Company Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Company Information</h5>
                </div>
                <div class="card-body">
                    <h5><?= htmlspecialchars($product['company_name']) ?></h5>
                    <p class="mb-2">
                        <small class="text-muted">Category:</small><br>
                        <span class="badge bg-secondary"><?= htmlspecialchars($product['category']) ?></span>
                    </p>
                    <a href="<?= htmlspecialchars($product['company_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                        Visit Website
                    </a>
                    <a href="/marketplace?company=<?= urlencode($product['company_url']) ?>" class="btn btn-sm btn-outline-secondary w-100 mt-2">
                        View All Products
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <?php if ($isLoggedIn): ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="/marketplace/wishlist" class="list-group-item list-group-item-action">
                            ♡ View Wishlist
                        </a>
                        <a href="/profile" class="list-group-item list-group-item-action">
                            👤 My Profile
                        </a>
                        <a href="/marketplace" class="list-group-item list-group-item-action">
                            🏪 Browse Marketplace
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Handle wishlist toggle with AJAX
document.getElementById('wishlistForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/marketplace/wishlist/toggle', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
