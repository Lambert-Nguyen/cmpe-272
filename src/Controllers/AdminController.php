<?php

require_once __DIR__ . '/Controller.php';

class AdminController extends Controller {
    
    public function __construct() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Display login form or redirect if already logged in
     */
    public function login() {
        // If already logged in, redirect to users page
        if ($this->isAuthenticated()) {
            header('Location: /admin/users');
            exit;
        }
        
        $data = [
            'title' => 'Admin Login - Lambert Engineering & Business Solutions',
            'error' => null
        ];
        
        // Handle POST request (login submission)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Simple authentication (userid and password method)
            if ($username === 'admin' && $password === 'admin') {
                // Set session variables
                $_SESSION['authenticated'] = true;
                $_SESSION['admin_username'] = $username;
                $_SESSION['login_time'] = time();
                
                // Redirect to secure section
                header('Location: /admin/users');
                exit;
            } else {
                $data['error'] = 'Invalid username or password. Please try again.';
            }
        }
        
        $this->render('admin/login', $data);
    }
    
    /**
     * Display the secure users list (requires authentication)
     */
    public function users() {
        // Check authentication
        if (!$this->isAuthenticated()) {
            header('Location: /admin/login');
            exit;
        }
        
        // Read users from text file
        $users = $this->loadUsers();
        
        $data = [
            'title' => 'Website Users - Secure Admin Section',
            'admin_username' => $_SESSION['admin_username'] ?? 'Admin',
            'users' => $users,
            'total_users' => count($users)
        ];
        
        $this->render('admin/users', $data);
    }
    
    /**
     * Handle logout
     */
    public function logout() {
        // Destroy session
        session_unset();
        session_destroy();
        
        // Redirect to login page with success message
        header('Location: /admin/login?logout=success');
        exit;
    }
    
    /**
     * Check if user is authenticated
     */
    private function isAuthenticated() {
        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
    }
    
    /**
     * Load users from text file
     */
    private function loadUsers() {
        $usersFile = __DIR__ . '/../../database/users.txt';
        $users = [];
        
        if (file_exists($usersFile)) {
            $lines = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            
            foreach ($lines as $line) {
                // Parse pipe-delimited format: Name|Email|Role|Status|JoinDate
                $parts = explode('|', $line);
                if (count($parts) >= 5) {
                    $users[] = [
                        'name' => trim($parts[0]),
                        'email' => trim($parts[1]),
                        'role' => trim($parts[2]),
                        'status' => trim($parts[3]),
                        'join_date' => trim($parts[4])
                    ];
                }
            }
        }
        
        return $users;
    }
}
