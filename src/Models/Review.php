<?php

require_once __DIR__ . '/Model.php';

class Review extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all reviews for a product
     *
     * @param int $product_id
     * @return array
     */
    public function getProductReviews($product_id)
    {
        $sql = "SELECT r.*, u.username, u.email, p.name as product_name, p.company_name
                FROM reviews r
                INNER JOIN users u ON r.user_id = u.id
                INNER JOIN products p ON r.product_id = p.id
                WHERE r.product_id = :product_id
                ORDER BY r.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all reviews by a user
     *
     * @param int $user_id
     * @return array
     */
    public function getUserReviews($user_id)
    {
        $sql = "SELECT r.*, p.name as product_name, p.company_name, p.company_url
                FROM reviews r
                INNER JOIN products p ON r.product_id = p.id
                WHERE r.user_id = :user_id
                ORDER BY r.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a specific review
     *
     * @param int $id
     * @return array|false
     */
    public function getReviewById($id)
    {
        $sql = "SELECT r.*, u.username, p.name as product_name, p.company_name
                FROM reviews r
                INNER JOIN users u ON r.user_id = u.id
                INNER JOIN products p ON r.product_id = p.id
                WHERE r.id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Check if user has already reviewed a product
     *
     * @param int $user_id
     * @param int $product_id
     * @return bool
     */
    public function hasUserReviewedProduct($user_id, $product_id)
    {
        $sql = "SELECT COUNT(*) FROM reviews WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Create a new review
     *
     * @param int $user_id
     * @param int $product_id
     * @param int $rating (1-5)
     * @param string $comment
     * @return array Validation result with 'success' and 'message' or 'id'
     */
    public function createReview($user_id, $product_id, $rating, $comment)
    {
        // Validate rating
        if ($rating < 1 || $rating > 5) {
            return ['success' => false, 'message' => 'Rating must be between 1 and 5'];
        }

        // Check if user already reviewed this product
        if ($this->hasUserReviewedProduct($user_id, $product_id)) {
            return ['success' => false, 'message' => 'You have already reviewed this product'];
        }

        // Validate comment
        $comment = trim($comment);
        if (empty($comment)) {
            return ['success' => false, 'message' => 'Review comment is required'];
        }

        if (strlen($comment) < 10) {
            return ['success' => false, 'message' => 'Review comment must be at least 10 characters'];
        }

        try {
            $sql = "INSERT INTO reviews (user_id, product_id, rating, comment)
                    VALUES (:user_id, :product_id, :rating, :comment)";

            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                ':rating' => $rating,
                ':comment' => $comment
            ]);

            if ($result) {
                return ['success' => true, 'id' => $this->db->lastInsertId()];
            } else {
                return ['success' => false, 'message' => 'Failed to create review'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    /**
     * Update a review
     *
     * @param int $id
     * @param int $rating
     * @param string $comment
     * @param int $user_id (for authorization check)
     * @return array
     */
    public function updateReview($id, $rating, $comment, $user_id)
    {
        // Validate rating
        if ($rating < 1 || $rating > 5) {
            return ['success' => false, 'message' => 'Rating must be between 1 and 5'];
        }

        // Validate comment
        $comment = trim($comment);
        if (empty($comment)) {
            return ['success' => false, 'message' => 'Review comment is required'];
        }

        if (strlen($comment) < 10) {
            return ['success' => false, 'message' => 'Review comment must be at least 10 characters'];
        }

        // Check if review exists and belongs to user
        $review = $this->getReviewById($id);
        if (!$review) {
            return ['success' => false, 'message' => 'Review not found'];
        }

        if ($review['user_id'] != $user_id) {
            return ['success' => false, 'message' => 'You can only edit your own reviews'];
        }

        try {
            $sql = "UPDATE reviews SET rating = :rating, comment = :comment WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                ':rating' => $rating,
                ':comment' => $comment,
                ':id' => $id
            ]);

            if ($result) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Failed to update review'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    /**
     * Delete a review
     *
     * @param int $id
     * @param int $user_id (for authorization check)
     * @return array
     */
    public function deleteReview($id, $user_id)
    {
        // Check if review exists and belongs to user
        $review = $this->getReviewById($id);
        if (!$review) {
            return ['success' => false, 'message' => 'Review not found'];
        }

        if ($review['user_id'] != $user_id) {
            return ['success' => false, 'message' => 'You can only delete your own reviews'];
        }

        try {
            $stmt = $this->db->prepare("DELETE FROM reviews WHERE id = :id");
            $result = $stmt->execute([':id' => $id]);

            if ($result) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Failed to delete review'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    /**
     * Get average rating for a product
     *
     * @param int $product_id
     * @return array
     */
    public function getProductRatingStats($product_id)
    {
        $sql = "SELECT
                COUNT(*) as total_reviews,
                AVG(rating) as avg_rating,
                SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_star,
                SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_star,
                SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_star,
                SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_star,
                SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star
                FROM reviews
                WHERE product_id = :product_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':product_id' => $product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calculate percentages
        if ($result['total_reviews'] > 0) {
            $result['five_star_pct'] = round(($result['five_star'] / $result['total_reviews']) * 100);
            $result['four_star_pct'] = round(($result['four_star'] / $result['total_reviews']) * 100);
            $result['three_star_pct'] = round(($result['three_star'] / $result['total_reviews']) * 100);
            $result['two_star_pct'] = round(($result['two_star'] / $result['total_reviews']) * 100);
            $result['one_star_pct'] = round(($result['one_star'] / $result['total_reviews']) * 100);
        } else {
            $result['five_star_pct'] = $result['four_star_pct'] = $result['three_star_pct'] =
            $result['two_star_pct'] = $result['one_star_pct'] = 0;
        }

        return $result;
    }

    /**
     * Get recent reviews across all products
     *
     * @param int $limit
     * @return array
     */
    public function getRecentReviews($limit = 10)
    {
        $sql = "SELECT r.*, u.username, p.name as product_name, p.company_name, p.company_url
                FROM reviews r
                INNER JOIN users u ON r.user_id = u.id
                INNER JOIN products p ON r.product_id = p.id
                ORDER BY r.created_at DESC
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
