<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-8">
        <h1><?php echo htmlspecialchars($title); ?></h1>
        
        <p class="lead"><?php echo htmlspecialchars($description); ?></p>
        
        <h3>Features</h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Custom MVC Framework</li>
            <li class="list-group-item">MySQL Database Integration</li>
            <li class="list-group-item">User Management System (CRUD)</li>
            <li class="list-group-item">Responsive Bootstrap UI</li>
            <li class="list-group-item">Environment Variable Configuration</li>
            <li class="list-group-item">Render Deployment Ready</li>
        </ul>
        
        <h3 class="mt-4">Technology Stack</h3>
        <div class="row">
            <div class="col-md-6">
                <h5>Backend</h5>
                <ul>
                    <li>PHP 8.0+</li>
                    <li>PDO for Database</li>
                    <li>Custom MVC Pattern</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Frontend</h5>
                <ul>
                    <li>Bootstrap 5</li>
                    <li>Responsive Design</li>
                    <li>Modern UI Components</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5>Course Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Student:</strong> Lam Nguyen</p>
                <p><strong>Course:</strong> CMPE 272</p>
                <p><strong>Professor:</strong> Prof. Richard Sinn</p>
                <p><strong>University:</strong> San Jose State University</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>