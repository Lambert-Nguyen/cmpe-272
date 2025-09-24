<?php

require_once __DIR__ . '/Controller.php';

class HomeController extends Controller {
    
    public function index() {
        $data = [
            'title' => 'Welcome to CMPE 272 PHP Application',
            'student_name' => 'Lam Nguyen',
            'course' => 'CMPE 272',
            'professor' => 'Prof. Richard Sinn',
            'university' => 'San Jose State University'
        ];
        
        $this->render('home/index', $data);
    }
    
    public function about() {
        $data = [
            'title' => 'About This Application',
            'description' => 'This is a PHP MVC application built for deployment on Render, featuring user management with MySQL database integration.'
        ];
        
        $this->render('home/about', $data);
    }
}