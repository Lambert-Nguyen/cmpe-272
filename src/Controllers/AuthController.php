<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();

        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Show login form / Handle login
     */
    public function login()
    {
        // If already logged in, redirect to home
        if ($this->isLoggedIn()) {
            $this->redirect('/');
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = $this->userModel->login($username, $password);

            if ($result['success']) {
                // Set session variables
                $_SESSION['user_id'] = $result['user']['id'];
                $_SESSION['username'] = $result['user']['username'];
                $_SESSION['email'] = $result['user']['email'];
                $_SESSION['logged_in'] = true;

                // Redirect to intended page or home
                $redirect = $_GET['redirect'] ?? '/';
                $this->redirect($redirect);
                return;
            } else {
                $error = $result['message'];
            }
        }

        $this->render('auth/login', [
            'title' => 'Login',
            'error' => $error
        ]);
    }

    /**
     * Show registration form / Handle registration
     */
    public function register()
    {
        // If already logged in, redirect to home
        if ($this->isLoggedIn()) {
            $this->redirect('/');
            return;
        }

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Validate passwords match
            if ($password !== $confirm_password) {
                $error = 'Passwords do not match';
            } else {
                $result = $this->userModel->register($username, $email, $password);

                if ($result['success']) {
                    $success = $result['message'];
                    // Auto-login after registration
                    $_SESSION['user_id'] = $result['user_id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['logged_in'] = true;

                    // Redirect to home
                    $this->redirect('/');
                    return;
                } else {
                    $error = $result['message'];
                }
            }
        }

        $this->render('auth/register', [
            'title' => 'Register',
            'error' => $error,
            'success' => $success
        ]);
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        // Destroy session
        session_unset();
        session_destroy();

        $this->redirect('/login');
    }

    /**
     * Check if user is logged in
     *
     * @return bool
     */
    public static function isLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    /**
     * Get current logged-in user ID
     *
     * @return int|null
     */
    public static function getCurrentUserId()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Get current logged-in user data
     *
     * @return array|null
     */
    public static function getCurrentUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email']
            ];
        }

        return null;
    }

    /**
     * Require authentication (redirect to login if not authenticated)
     */
    public static function requireAuth()
    {
        if (!self::isLoggedIn()) {
            $currentUrl = $_SERVER['REQUEST_URI'];
            header("Location: /login?redirect=" . urlencode($currentUrl));
            exit;
        }
    }
}
