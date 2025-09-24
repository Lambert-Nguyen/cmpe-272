<?php

class Router {
    private $routes = [];
    
    public function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function handleRequest() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remove trailing slash except for root
        if ($requestPath !== '/' && substr($requestPath, -1) === '/') {
            $requestPath = rtrim($requestPath, '/');
        }
        
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route, $requestMethod, $requestPath)) {
                $controllerName = $route['controller'];
                $action = $route['action'];
                
                // Include the controller file
                $controllerFile = __DIR__ . '/../src/Controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                    
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        $controller->$action();
                        return;
                    }
                }
                
                $this->show404();
                return;
            }
        }
        
        $this->show404();
    }
    
    private function matchRoute($route, $method, $path) {
        return $route['method'] === $method && $route['path'] === $path;
    }
    
    private function show404() {
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The requested page could not be found.</p>";
    }
}