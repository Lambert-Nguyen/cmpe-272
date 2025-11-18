<?php

require_once __DIR__ . '/Model.php';

class User extends Model {
    protected $table = 'users';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAllUsers() {
        return $this->findAll();
    }
    
    public function getUserById($id) {
        return $this->findById($id);
    }
    
    public function createUser($username, $email, $password = null) {
        // Validate input
        if (empty($username) || empty($email)) {
            throw new InvalidArgumentException("Username and email are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format");
        }

        // Check if username or email already exists
        if ($this->usernameExists($username)) {
            throw new Exception("Username already exists");
        }

        if ($this->emailExists($email)) {
            throw new Exception("Email already exists");
        }

        $data = [
            'username' => trim($username),
            'email' => trim($email)
        ];

        // Add password if provided
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        return $this->create($data);
    }

    /**
     * Register a new user with authentication
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return array Result with success status and message
     */
    public function register($username, $email, $password) {
        // Validate input
        if (empty($username) || empty($email) || empty($password)) {
            return ['success' => false, 'message' => 'All fields are required'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }

        if (strlen($password) < 6) {
            return ['success' => false, 'message' => 'Password must be at least 6 characters'];
        }

        // Check if username or email already exists
        if ($this->usernameExists($username)) {
            return ['success' => false, 'message' => 'Username already exists'];
        }

        if ($this->emailExists($email)) {
            return ['success' => false, 'message' => 'Email already exists'];
        }

        try {
            $data = [
                'username' => trim($username),
                'email' => trim($email),
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            $userId = $this->create($data);

            if ($userId) {
                return ['success' => true, 'user_id' => $userId, 'message' => 'Registration successful'];
            } else {
                return ['success' => false, 'message' => 'Failed to create user'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Authenticate a user
     *
     * @param string $username
     * @param string $password
     * @return array Result with success status, user data or error message
     */
    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            return ['success' => false, 'message' => 'Username and password are required'];
        }

        $user = $this->getUserByUsername($username);

        if (!$user) {
            return ['success' => false, 'message' => 'Invalid username or password'];
        }

        if (password_verify($password, $user['password'])) {
            // Don't return password in response
            unset($user['password']);
            return ['success' => true, 'user' => $user];
        } else {
            return ['success' => false, 'message' => 'Invalid username or password'];
        }
    }

    /**
     * Get user by username
     *
     * @param string $username
     * @return array|false
     */
    public function getUserByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update user password
     *
     * @param int $userId
     * @param string $newPassword
     * @return bool
     */
    public function updatePassword($userId, $newPassword) {
        if (strlen($newPassword) < 6) {
            throw new InvalidArgumentException('Password must be at least 6 characters');
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($userId, ['password' => $hashedPassword]);
    }
    
    public function updateUser($id, $username, $email) {
        // Validate input
        if (empty($username) || empty($email)) {
            throw new InvalidArgumentException("Username and email are required");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format");
        }
        
        // Check if user exists
        $existingUser = $this->getUserById($id);
        if (!$existingUser) {
            throw new Exception("User not found");
        }
        
        // Check if username or email already exists (excluding current user)
        if ($this->usernameExists($username, $id)) {
            throw new Exception("Username already exists");
        }
        
        if ($this->emailExists($email, $id)) {
            throw new Exception("Email already exists");
        }
        
        $data = [
            'username' => trim($username),
            'email' => trim($email)
        ];
        
        return $this->update($id, $data);
    }
    
    public function deleteUser($id) {
        $user = $this->getUserById($id);
        if (!$user) {
            throw new Exception("User not found");
        }
        
        return $this->delete($id);
    }
    
    private function usernameExists($username, $excludeId = null) {
        $sql = "SELECT id FROM {$this->table} WHERE username = :username";
        if ($excludeId) {
            $sql .= " AND id != :exclude_id";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        if ($excludeId) {
            $stmt->bindParam(':exclude_id', $excludeId);
        }
        
        $stmt->execute();
        return $stmt->fetch() !== false;
    }
    
    private function emailExists($email, $excludeId = null) {
        $sql = "SELECT id FROM {$this->table} WHERE email = :email";
        if ($excludeId) {
            $sql .= " AND id != :exclude_id";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        if ($excludeId) {
            $stmt->bindParam(':exclude_id', $excludeId);
        }
        
        $stmt->execute();
        return $stmt->fetch() !== false;
    }
}