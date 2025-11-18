<?php

require_once __DIR__ . '/Model.php';

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all products with optional filters
     *
     * @param array $filters Optional filters (category, company_url, price_min, price_max, search, min_rating)
     * @param string $orderBy Order by field (visits, rating, price, created_at)
     * @param int $limit Limit number of results
     * @return array
     */
    public function getAllProducts($filters = [], $orderBy = 'created_at', $limit = null)
    {
        $sql = "SELECT p.*,
                COALESCE(AVG(r.rating), 0) as avg_rating,
                COUNT(DISTINCT r.id) as review_count,
                COUNT(DISTINCT pv.id) as visit_count
                FROM products p
                LEFT JOIN reviews r ON p.id = r.product_id
                LEFT JOIN product_visits pv ON p.id = pv.product_id
                WHERE 1=1";

        $params = [];

        // Apply filters
        if (!empty($filters['category'])) {
            $sql .= " AND p.category = :category";
            $params[':category'] = $filters['category'];
        }

        if (!empty($filters['company_url'])) {
            $sql .= " AND p.company_url = :company_url";
            $params[':company_url'] = $filters['company_url'];
        }

        if (!empty($filters['price_min'])) {
            $sql .= " AND p.price >= :price_min";
            $params[':price_min'] = $filters['price_min'];
        }

        if (!empty($filters['price_max'])) {
            $sql .= " AND p.price <= :price_max";
            $params[':price_max'] = $filters['price_max'];
        }

        if (!empty($filters['search'])) {
            $sql .= " AND (p.name LIKE :search OR p.description LIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        $sql .= " GROUP BY p.id";

        // Filter by minimum rating (after aggregation)
        if (!empty($filters['min_rating'])) {
            $sql .= " HAVING avg_rating >= :min_rating";
            $params[':min_rating'] = $filters['min_rating'];
        }

        // Order by
        switch ($orderBy) {
            case 'visits':
                $sql .= " ORDER BY visit_count DESC";
                break;
            case 'rating':
                $sql .= " ORDER BY avg_rating DESC, review_count DESC";
                break;
            case 'price_asc':
                $sql .= " ORDER BY p.price ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY p.price DESC";
                break;
            case 'name':
                $sql .= " ORDER BY p.name ASC";
                break;
            default:
                $sql .= " ORDER BY p.created_at DESC";
        }

        if ($limit) {
            $sql .= " LIMIT :limit";
            $params[':limit'] = $limit;
        }

        $stmt = $this->db->prepare($sql);

        // Bind limit separately as integer
        if ($limit) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            unset($params[':limit']);
        }

        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get product by ID with rating and visit statistics
     *
     * @param int $id
     * @return array|false
     */
    public function getProductById($id)
    {
        $sql = "SELECT p.*,
                COALESCE(AVG(r.rating), 0) as avg_rating,
                COUNT(DISTINCT r.id) as review_count,
                COUNT(DISTINCT pv.id) as visit_count
                FROM products p
                LEFT JOIN reviews r ON p.id = r.product_id
                LEFT JOIN product_visits pv ON p.id = pv.product_id
                WHERE p.id = :id
                GROUP BY p.id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new product
     *
     * @param string $name
     * @param string $description
     * @param float $price
     * @param string $category
     * @param string $company_name
     * @param string $company_url
     * @param string $image_url
     * @return int|false Product ID or false on failure
     */
    public function createProduct($name, $description, $price, $category, $company_name, $company_url, $image_url = null)
    {
        $sql = "INSERT INTO products (name, description, price, category, company_name, company_url, image_url)
                VALUES (:name, :description, :price, :category, :company_name, :company_url, :image_url)";

        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':category' => $category,
            ':company_name' => $company_name,
            ':company_url' => $company_url,
            ':image_url' => $image_url
        ]);

        return $result ? $this->db->lastInsertId() : false;
    }

    /**
     * Update a product
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateProduct($id, $data)
    {
        $fields = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $sql = "UPDATE products SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Delete a product
     *
     * @param int $id
     * @return bool
     */
    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    /**
     * Get all unique categories
     *
     * @return array
     */
    public function getCategories()
    {
        $sql = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL ORDER BY category";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Get all unique companies
     *
     * @return array
     */
    public function getCompanies()
    {
        $sql = "SELECT DISTINCT company_name, company_url FROM products ORDER BY company_name";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get top N products by visit count
     *
     * @param int $limit
     * @param string $company_url Optional company filter
     * @return array
     */
    public function getTopProductsByVisits($limit = 5, $company_url = null)
    {
        $sql = "SELECT p.*,
                COALESCE(AVG(r.rating), 0) as avg_rating,
                COUNT(DISTINCT r.id) as review_count,
                COUNT(DISTINCT pv.id) as visit_count
                FROM products p
                LEFT JOIN reviews r ON p.id = r.product_id
                LEFT JOIN product_visits pv ON p.id = pv.product_id";

        if ($company_url) {
            $sql .= " WHERE p.company_url = :company_url";
        }

        $sql .= " GROUP BY p.id
                  ORDER BY visit_count DESC, avg_rating DESC
                  LIMIT :limit";

        $stmt = $this->db->prepare($sql);

        if ($company_url) {
            $stmt->bindValue(':company_url', $company_url);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get top N products by rating
     *
     * @param int $limit
     * @param string $company_url Optional company filter
     * @return array
     */
    public function getTopProductsByRating($limit = 5, $company_url = null)
    {
        $sql = "SELECT p.*,
                COALESCE(AVG(r.rating), 0) as avg_rating,
                COUNT(DISTINCT r.id) as review_count,
                COUNT(DISTINCT pv.id) as visit_count
                FROM products p
                LEFT JOIN reviews r ON p.id = r.product_id
                LEFT JOIN product_visits pv ON p.id = pv.product_id";

        if ($company_url) {
            $sql .= " WHERE p.company_url = :company_url";
        }

        $sql .= " GROUP BY p.id
                  HAVING review_count > 0
                  ORDER BY avg_rating DESC, review_count DESC
                  LIMIT :limit";

        $stmt = $this->db->prepare($sql);

        if ($company_url) {
            $stmt->bindValue(':company_url', $company_url);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Record a product visit
     *
     * @param int $product_id
     * @param int $user_id (optional)
     * @param string $ip_address
     * @return bool
     */
    public function recordVisit($product_id, $user_id = null, $ip_address = null)
    {
        $sql = "INSERT INTO product_visits (product_id, user_id, ip_address) VALUES (:product_id, :user_id, :ip_address)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':product_id' => $product_id,
            ':user_id' => $user_id,
            ':ip_address' => $ip_address
        ]);
    }

    /**
     * Get user's recently visited products
     *
     * @param int $user_id
     * @param int $limit
     * @return array
     */
    public function getUserRecentlyVisited($user_id, $limit = 10)
    {
        $sql = "SELECT p.*,
                COALESCE(AVG(r.rating), 0) as avg_rating,
                COUNT(DISTINCT r.id) as review_count,
                MAX(pv.visited_at) as last_visited
                FROM products p
                INNER JOIN product_visits pv ON p.id = pv.product_id
                LEFT JOIN reviews r ON p.id = r.product_id
                WHERE pv.user_id = :user_id
                GROUP BY p.id
                ORDER BY last_visited DESC
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
