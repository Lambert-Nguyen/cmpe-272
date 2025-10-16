<?php
ob_start();
?>

<div class="admin-login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-5 col-lg-4">
                <div class="login-card" data-aos="fade-up">
                    <div class="login-header text-center mb-4">
                        <div class="lock-icon mb-3">
                            <i class="fas fa-shield-halved fa-3x"></i>
                        </div>
                        <h2 class="mb-2">Admin Login</h2>
                        <p class="text-muted">Secure Access Required</p>
                    </div>
                    
                    <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            You have been successfully logged out.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($error) && $error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/admin/login" class="login-form">
                        <div class="mb-3">
                            <label for="username" class="form-label">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                            <input 
                                type="text" 
                                class="form-control form-control-lg" 
                                id="username" 
                                name="username" 
                                placeholder="Enter username"
                                required 
                                autofocus
                            >
                            <div class="form-text">
                                <small class="text-muted">Use: <code>admin</code></small>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <input 
                                type="password" 
                                class="form-control form-control-lg" 
                                id="password" 
                                name="password" 
                                placeholder="Enter password"
                                required
                            >
                            <div class="form-text">
                                <small class="text-muted">Use: <code>admin</code></small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </button>
                        
                        <div class="text-center">
                            <a href="/" class="text-muted">
                                <i class="fas fa-arrow-left me-1"></i>Back to Homepage
                            </a>
                        </div>
                    </form>
                    
                    <div class="login-footer mt-4 pt-3 border-top">
                        <p class="text-center text-muted mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            <small>This is a secure section for administrators only.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.admin-login-page {
    padding-top: 80px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

.login-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    padding: 2.5rem;
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.lock-icon {
    color: #667eea;
}

.login-header h2 {
    color: #2d3748;
    font-weight: 600;
}

.login-form .form-label {
    color: #4a5568;
    font-weight: 500;
}

.login-form .form-control {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}

.login-form .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.login-form .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 10px;
    padding: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.login-form .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.login-footer {
    border-top: 1px solid #e2e8f0 !important;
}

code {
    background: #f7fafc;
    padding: 2px 6px;
    border-radius: 4px;
    color: #667eea;
    font-weight: 600;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
