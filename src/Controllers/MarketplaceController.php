<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Models/Review.php';
require_once __DIR__ . '/../Models/Wishlist.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/AuthController.php';

class MarketplaceController extends Controller
{
    private $productModel;
    private $reviewModel;
    private $wishlistModel;
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->productModel = new Product();
        $this->reviewModel = new Review();
        $this->wishlistModel = new Wishlist();
        $this->userModel = new User();
    }

    /**
     * Marketplace homepage with all products and companies
     */
    public function index()
    {
        $filters = [
            'category' => $_GET['category'] ?? null,
            'company_url' => $_GET['company'] ?? null,
            'price_min' => $_GET['price_min'] ?? null,
            'price_max' => $_GET['price_max'] ?? null,
            'search' => $_GET['search'] ?? null,
            'min_rating' => $_GET['min_rating'] ?? null
        ];

        // Remove empty filters
        $filters = array_filter($filters);

        $orderBy = $_GET['sort'] ?? 'created_at';
        $products = $this->productModel->getAllProducts($filters, $orderBy);
        $categories = $this->productModel->getCategories();
        $companies = $this->productModel->getCompanies();

        // Get top 5 marketplace-wide
        $topProducts = $this->productModel->getTopProductsByVisits(5);

        // Get recent reviews
        $recentReviews = $this->reviewModel->getRecentReviews(5);

        $this->render('marketplace/index', [
            'title' => 'Marketplace - All Products',
            'products' => $products,
            'categories' => $categories,
            'companies' => $companies,
            'topProducts' => $topProducts,
            'recentReviews' => $recentReviews,
            'filters' => $filters,
            'currentSort' => $orderBy
        ]);
    }

    /**
     * Show top 5 products marketplace-wide
     */
    public function top5()
    {
        $topByVisits = $this->productModel->getTopProductsByVisits(5);
        $topByRating = $this->productModel->getTopProductsByRating(5);

        $this->render('marketplace/top5', [
            'title' => 'Top 5 Products - Marketplace',
            'topByVisits' => $topByVisits,
            'topByRating' => $topByRating
        ]);
    }

    /**
     * Show top 5 products per company
     */
    public function companyTop5()
    {
        $companies = $this->productModel->getCompanies();
        $topProductsByCompany = [];

        foreach ($companies as $company) {
            $topProductsByCompany[$company['company_name']] = [
                'company_url' => $company['company_url'],
                'products' => $this->productModel->getTopProductsByVisits(5, $company['company_url'])
            ];
        }

        $this->render('marketplace/company-top5', [
            'title' => 'Top 5 Products by Company',
            'topProductsByCompany' => $topProductsByCompany
        ]);
    }

    /**
     * Show all companies in marketplace
     */
    public function companies()
    {
        $companies = $this->productModel->getCompanies();
        $companyStats = [];

        foreach ($companies as $company) {
            $products = $this->productModel->getAllProducts(['company_url' => $company['company_url']]);
            $companyStats[$company['company_name']] = [
                'company_url' => $company['company_url'],
                'product_count' => count($products),
                'products' => $products
            ];
        }

        $this->render('marketplace/companies', [
            'title' => 'All Companies',
            'companyStats' => $companyStats
        ]);
    }

    /**
     * Show single product details
     */
    public function product()
    {
        $productId = $_GET['id'] ?? null;

        if (!$productId) {
            $this->redirect('/marketplace');
            return;
        }

        $product = $this->productModel->getProductById($productId);

        if (!$product) {
            $this->redirect('/marketplace');
            return;
        }

        // Record visit
        $userId = AuthController::getCurrentUserId();
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? null;
        $this->productModel->recordVisit($productId, $userId, $ipAddress);

        // Get reviews
        $reviews = $this->reviewModel->getProductReviews($productId);
        $ratingStats = $this->reviewModel->getProductRatingStats($productId);

        // Check if user has reviewed
        $userReview = null;
        if ($userId) {
            foreach ($reviews as $review) {
                if ($review['user_id'] == $userId) {
                    $userReview = $review;
                    break;
                }
            }
        }

        // Check if in wishlist
        $inWishlist = false;
        if ($userId) {
            $inWishlist = $this->wishlistModel->isInWishlist($userId, $productId);
        }

        $this->render('marketplace/product', [
            'title' => $product['name'],
            'product' => $product,
            'reviews' => $reviews,
            'ratingStats' => $ratingStats,
            'userReview' => $userReview,
            'inWishlist' => $inWishlist
        ]);
    }

    /**
     * Submit a review (requires login)
     */
    public function submitReview()
    {
        AuthController::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/marketplace');
            return;
        }

        $userId = AuthController::getCurrentUserId();
        $productId = $_POST['product_id'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? '';

        if (!$productId || !$rating) {
            $_SESSION['error'] = 'Missing required fields';
            $this->redirect('/marketplace/product?id=' . $productId);
            return;
        }

        $result = $this->reviewModel->createReview($userId, $productId, $rating, $comment);

        if ($result['success']) {
            $_SESSION['success'] = 'Review submitted successfully!';
        } else {
            $_SESSION['error'] = $result['message'];
        }

        $this->redirect('/marketplace/product?id=' . $productId);
    }

    /**
     * Update a review
     */
    public function updateReview()
    {
        AuthController::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/marketplace');
            return;
        }

        $userId = AuthController::getCurrentUserId();
        $reviewId = $_POST['review_id'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? '';
        $productId = $_POST['product_id'] ?? null;

        if (!$reviewId || !$rating) {
            $_SESSION['error'] = 'Missing required fields';
            $this->redirect('/marketplace/product?id=' . $productId);
            return;
        }

        $result = $this->reviewModel->updateReview($reviewId, $rating, $comment, $userId);

        if ($result['success']) {
            $_SESSION['success'] = 'Review updated successfully!';
        } else {
            $_SESSION['error'] = $result['message'];
        }

        $this->redirect('/marketplace/product?id=' . $productId);
    }

    /**
     * Delete a review
     */
    public function deleteReview()
    {
        AuthController::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/marketplace');
            return;
        }

        $userId = AuthController::getCurrentUserId();
        $reviewId = $_POST['review_id'] ?? null;
        $productId = $_POST['product_id'] ?? null;

        if (!$reviewId) {
            $_SESSION['error'] = 'Review ID is required';
            $this->redirect('/marketplace/product?id=' . $productId);
            return;
        }

        $result = $this->reviewModel->deleteReview($reviewId, $userId);

        if ($result['success']) {
            $_SESSION['success'] = 'Review deleted successfully!';
        } else {
            $_SESSION['error'] = $result['message'];
        }

        $this->redirect('/marketplace/product?id=' . $productId);
    }

    /**
     * Toggle wishlist (add/remove)
     */
    public function toggleWishlist()
    {
        AuthController::requireAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            return;
        }

        $userId = AuthController::getCurrentUserId();
        $productId = $_POST['product_id'] ?? null;

        if (!$productId) {
            echo json_encode(['success' => false, 'message' => 'Product ID is required']);
            return;
        }

        $result = $this->wishlistModel->toggleWishlist($userId, $productId);
        echo json_encode($result);
    }

    /**
     * Show user's wishlist
     */
    public function wishlist()
    {
        AuthController::requireAuth();

        $userId = AuthController::getCurrentUserId();
        $wishlistItems = $this->wishlistModel->getUserWishlist($userId);

        $this->render('marketplace/wishlist', [
            'title' => 'My Wishlist',
            'wishlistItems' => $wishlistItems
        ]);
    }

    /**
     * User profile showing reviews and visit history
     */
    public function profile()
    {
        AuthController::requireAuth();

        $userId = AuthController::getCurrentUserId();
        $user = $this->userModel->getUserById($userId);
        $reviews = $this->reviewModel->getUserReviews($userId);
        $recentlyVisited = $this->productModel->getUserRecentlyVisited($userId, 10);
        $wishlistCount = $this->wishlistModel->getWishlistCount($userId);

        $this->render('marketplace/profile', [
            'title' => 'My Profile',
            'user' => $user,
            'reviews' => $reviews,
            'recentlyVisited' => $recentlyVisited,
            'wishlistCount' => $wishlistCount
        ]);
    }
}
