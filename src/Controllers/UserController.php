<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Models/User.php';

class UserController extends Controller {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function index() {
        try {
            $users = $this->userModel->getAllUsers();
            $data = [
                'title' => 'User Management',
                'users' => $users
            ];
            $this->render('users/index', $data);
        } catch (Exception $e) {
            $data = [
                'title' => 'User Management',
                'error' => $e->getMessage(),
                'users' => []
            ];
            $this->render('users/index', $data);
        }
    }
    
    public function show() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/users');
            return;
        }
        
        try {
            $user = $this->userModel->getUserById($id);
            if (!$user) {
                throw new Exception("User not found");
            }
            
            $data = [
                'title' => 'User Details',
                'user' => $user
            ];
            $this->render('users/show', $data);
        } catch (Exception $e) {
            $data = [
                'title' => 'User Details',
                'error' => $e->getMessage()
            ];
            $this->render('users/show', $data);
        }
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = $_POST['username'] ?? '';
                $email = $_POST['email'] ?? '';
                
                $userId = $this->userModel->createUser($username, $email);
                $this->redirect('/users');
                return;
            } catch (Exception $e) {
                $data = [
                    'title' => 'Create User',
                    'error' => $e->getMessage(),
                    'username' => $_POST['username'] ?? '',
                    'email' => $_POST['email'] ?? ''
                ];
                $this->render('users/create', $data);
                return;
            }
        }
        
        $data = [
            'title' => 'Create User'
        ];
        $this->render('users/create', $data);
    }
    
    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/users');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $username = $_POST['username'] ?? '';
                $email = $_POST['email'] ?? '';
                
                $this->userModel->updateUser($id, $username, $email);
                $this->redirect('/users');
                return;
            } catch (Exception $e) {
                $user = $this->userModel->getUserById($id);
                $data = [
                    'title' => 'Edit User',
                    'error' => $e->getMessage(),
                    'user' => $user,
                    'username' => $_POST['username'] ?? '',
                    'email' => $_POST['email'] ?? ''
                ];
                $this->render('users/edit', $data);
                return;
            }
        }
        
        try {
            $user = $this->userModel->getUserById($id);
            if (!$user) {
                throw new Exception("User not found");
            }
            
            $data = [
                'title' => 'Edit User',
                'user' => $user
            ];
            $this->render('users/edit', $data);
        } catch (Exception $e) {
            $this->redirect('/users');
        }
    }
    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                try {
                    $this->userModel->deleteUser($id);
                } catch (Exception $e) {
                    // Handle error silently for now
                }
            }
        }
        $this->redirect('/users');
    }
}