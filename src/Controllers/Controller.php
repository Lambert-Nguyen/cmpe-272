<?php

abstract class Controller {
    public function __construct() {
        // Base constructor - can be overridden by child classes
    }

    protected function render($view, $data = []) {
        // Extract data array to variables
        extract($data);
        
        // Include the view file
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View file not found: {$view}");
        }
    }
    
    protected function redirect($url) {
        header("Location: {$url}");
        exit();
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}