<?php

// Start session for authentication
session_start();

// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up autoloading and includes
require_once __DIR__ . '/../config/Router.php';
require_once __DIR__ . '/../src/Controllers/HomeController.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';
require_once __DIR__ . '/../src/Controllers/CompanyController.php';
require_once __DIR__ . '/../src/Controllers/AdminController.php';
require_once __DIR__ . '/../src/Controllers/ProductController.php';

// Initialize the router
$router = new Router();

// Company routes (main website)
$router->addRoute('GET', '/company', 'CompanyController', 'index');
$router->addRoute('GET', '/company/about', 'CompanyController', 'about');
$router->addRoute('GET', '/company/products', 'CompanyController', 'products');
$router->addRoute('GET', '/company/news', 'CompanyController', 'news');
$router->addRoute('GET', '/company/contacts', 'CompanyController', 'contacts');

// Admin routes (secure section)
$router->addRoute('GET', '/admin/login', 'AdminController', 'login');
$router->addRoute('POST', '/admin/login', 'AdminController', 'login');
$router->addRoute('GET', '/admin/logout', 'AdminController', 'logout');
$router->addRoute('GET', '/admin/users', 'AdminController', 'users');

// Product routes (cookie tracking)
$router->addRoute('GET', '/products/show', 'ProductController', 'show');
$router->addRoute('GET', '/products/recently-visited', 'ProductController', 'recentlyVisited');
$router->addRoute('GET', '/products/most-visited', 'ProductController', 'mostVisited');

// Legacy routes (CMPE 272 app)
$router->addRoute('GET', '/', 'CompanyController', 'index'); // Changed to company homepage
$router->addRoute('GET', '/about', 'HomeController', 'about');

// User routes
$router->addRoute('GET', '/users', 'UserController', 'index');
$router->addRoute('GET', '/users/create', 'UserController', 'create');
$router->addRoute('POST', '/users/create', 'UserController', 'create');
$router->addRoute('GET', '/users/show', 'UserController', 'show');
$router->addRoute('GET', '/users/edit', 'UserController', 'edit');
$router->addRoute('POST', '/users/edit', 'UserController', 'edit');
$router->addRoute('POST', '/users/delete', 'UserController', 'delete');

// Handle the request
try {
    $router->handleRequest();
} catch (Exception $e) {
    // Handle errors gracefully
    http_response_code(500);
    echo "<h1>500 - Internal Server Error</h1>";
    echo "<p>Something went wrong. Please try again later.</p>";
    
    // In development, show the error details
    if (getenv('APP_ENV') !== 'production') {
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    }
}