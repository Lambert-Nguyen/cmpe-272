<?php

require_once __DIR__ . '/Model.php';

class Wishlist extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all wishlist items for a user
     *
     * @param int $user_id
     * @return array
     */
    public function getUserWishlist($user_id)
    {
        $sql = "SELECT w.*, p.*,
                COALESCE(AVG(r.rating), 0) as avg_rating,
                COUNT(DISTINCT r.id) as review_count
                FROM wishlists w
                INNER JOIN products p ON w.product_id = p.id
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE w.user_id = :user_id
                GROUP BY w.id, p.id
                ORDER BY w.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Check if product is in user's wishlist
     *
     * @param int $user_id
     * @param int $product_id
     * @return bool
     */
    public function isInWishlist($user_id, $product_id)
    {
        $sql = "SELECT COUNT(*) FROM wishlists WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id, ':product_id' => $product_id]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Add product to wishlist
     *
     * @param int $user_id
     * @param int $product_id
     * @return array
     */
    public function addToWishlist($user_id, $product_id)
    {
        // Check if already in wishlist
        if ($this->isInWishlist($user_id, $product_id)) {
            return ['success' => false, 'message' => 'Product is already in your wishlist'];
        }

        try {
            $sql = "INSERT INTO wishlists (user_id, product_id) VALUES (:user_id, :product_id)";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id
            ]);

            if ($result) {
                return ['success' => true, 'message' => 'Product added to wishlist'];
            } else {
                return ['success' => false, 'message' => 'Failed to add product to wishlist'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    /**
     * Remove product from wishlist
     *
     * @param int $user_id
     * @param int $product_id
     * @return array
     */
    public function removeFromWishlist($user_id, $product_id)
    {
        try {
            $sql = "DELETE FROM wishlists WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                ':user_id' => $user_id,
                ':product_id' => $product_id
            ]);

            if ($result) {
                return ['success' => true, 'message' => 'Product removed from wishlist'];
            } else {
                return ['success' => false, 'message' => 'Failed to remove product from wishlist'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    /**
     * Toggle product in wishlist (add if not present, remove if present)
     *
     * @param int $user_id
     * @param int $product_id
     * @return array
     */
    public function toggleWishlist($user_id, $product_id)
    {
        if ($this->isInWishlist($user_id, $product_id)) {
            return $this->removeFromWishlist($user_id, $product_id);
        } else {
            return $this->addToWishlist($user_id, $product_id);
        }
    }

    /**
     * Get wishlist count for a user
     *
     * @param int $user_id
     * @return int
     */
    public function getWishlistCount($user_id)
    {
        $sql = "SELECT COUNT(*) FROM wishlists WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchColumn();
    }

    /**
     * Clear all wishlist items for a user
     *
     * @param int $user_id
     * @return bool
     */
    public function clearWishlist($user_id)
    {
        $stmt = $this->db->prepare("DELETE FROM wishlists WHERE user_id = :user_id");
        return $stmt->execute([':user_id' => $user_id]);
    }
}
