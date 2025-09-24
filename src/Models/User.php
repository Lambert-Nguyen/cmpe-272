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
    
    public function createUser($username, $email) {
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
        
        return $this->create($data);
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