<?php ob_start(); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <!-- Page Header -->
            <div class="text-center mb-4" data-aos="fade-down">
                <h1 class="text-gradient"><?php echo htmlspecialchars($title); ?></h1>
                <p class="text-muted">Add a new user to the system</p>
            </div>

            <!-- Form Card -->
            <div class="modern-form-container" data-aos="fade-up">
                <!-- Error Alert -->
                <?php if (isset($error)): ?>
                    <div class="modern-alert modern-alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="/users/create" id="createUserForm">
                    <div class="mb-4">
                        <label for="username" class="modern-form-label">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <input type="text" 
                               class="form-control modern-form-control" 
                               id="username" 
                               name="username" 
                               value="<?php echo htmlspecialchars($username ?? ''); ?>" 
                               placeholder="Enter username"
                               required>
                        <div class="form-text">Username must be unique and contain only letters, numbers, and underscores.</div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="modern-form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input type="email" 
                               class="form-control modern-form-control" 
                               id="email" 
                               name="email" 
                               value="<?php echo htmlspecialchars($email ?? ''); ?>" 
                               placeholder="Enter email address"
                               required>
                        <div class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    
                    <div class="d-grid gap-3 mt-4">
                        <button type="submit" class="btn-modern btn-modern-primary">
                            <i class="fas fa-user-plus me-2"></i>
                            Create User
                        </button>
                        <a href="/users" class="btn-modern btn-modern-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to Users
                        </a>
                    </div>
                </form>
            </div>

            <!-- Help Card -->
            <div class="modern-card mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body text-center">
                    <h5 class="modern-card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Quick Tips
                    </h5>
                    <div class="row text-start">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Use unique usernames
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Valid email format required
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    All fields are mandatory
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Data is securely stored
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createUserForm');
    const inputs = form.querySelectorAll('input');
    
    // Add real-time validation feedback
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateInput(this);
        });
        
        input.addEventListener('blur', function() {
            validateInput(this);
        });
    });
    
    function validateInput(input) {
        const isValid = input.checkValidity();
        
        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
        }
    }
});
</script>

<style>
.form-control.is-valid {
    border-color: var(--success);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310b981' d='m2.3 6.73.94.94 2.94-2.94a.75.75 0 0 1 1.06 1.06L3.24 9.79a.75.75 0 0 1-1.06 0L.18 7.79a.75.75 0 1 1 1.06-1.06l1.06 1.06z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem 1rem;
}

.form-control.is-invalid {
    border-color: var(--error);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23ef4444'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.5 5.5 3 3m0-3-3 3'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem 1rem;
}

.form-text {
    color: var(--gray-500);
    font-size: 0.875rem;
    margin-top: 0.5rem;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>