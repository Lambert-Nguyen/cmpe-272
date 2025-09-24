<?php ob_start(); ?>

<div class="jumbotron bg-primary text-white p-5 rounded mb-4">
    <div class="container-fluid">
        <h1 class="display-4">Welcome to CMPE 272 PHP Application</h1>
        <p class="lead">Built by <?php echo htmlspecialchars($student_name); ?> for <?php echo htmlspecialchars($course); ?></p>
        <p class="lead">Taught by <?php echo htmlspecialchars($professor); ?> at <?php echo htmlspecialchars($university); ?></p>
        <hr class="my-4">
        <p>This is a PHP MVC web application designed for deployment on Render with MySQL database integration.</p>
        <a class="btn btn-light btn-lg" href="/users" role="button">View Users</a>
        <a class="btn btn-outline-light btn-lg" href="/about" role="button">Learn More</a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">MVC Architecture</h5>
                <p class="card-text">Built with custom MVC pattern for clean separation of concerns and maintainable code structure.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">MySQL Integration</h5>
                <p class="card-text">Full CRUD operations with MySQL database, configured for Render's managed database service.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cloud Ready</h5>
                <p class="card-text">Designed for deployment on Render with environment variable configuration and production-ready setup.</p>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>