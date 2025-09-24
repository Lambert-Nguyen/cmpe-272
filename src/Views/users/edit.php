<?php ob_start(); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <!-- Page Header -->
            <div class="text-center mb-4" data-aos="fade-down">
                <h1 class="text-gradient"><?php echo htmlspecialchars($title); ?></h1>
                <p class="text-muted">Update user information</p>
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
                
                <?php if (isset($user)): ?>
                    <!-- User Info Header -->
                    <div class="user-edit-header mb-4">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">
                                <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
                            </div>
                            <div>
                                <h5 class="mb-1">Editing User #<?php echo $user['id']; ?></h5>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    Created: <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="/users/edit?id=<?php echo $user['id']; ?>" id="editUserForm">
                        <div class="mb-4">
                            <label for="username" class="modern-form-label">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                            <input type="text" 
                                   class="form-control modern-form-control" 
                                   id="username" 
                                   name="username" 
                                   value="<?php echo htmlspecialchars($username ?? $user['username']); ?>" 
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
                                   value="<?php echo htmlspecialchars($email ?? $user['email']); ?>" 
                                   placeholder="Enter email address"
                                   required>
                            <div class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        
                        <div class="d-grid gap-3 mt-4">
                            <button type="submit" class="btn-modern btn-modern-primary">
                                <i class="fas fa-save me-2"></i>
                                Update User
                            </button>
                            <div class="row g-2">
                                <div class="col">
                                    <a href="/users/show?id=<?php echo $user['id']; ?>" class="btn-modern btn-modern-secondary w-100">
                                        <i class="fas fa-eye me-2"></i>
                                        View User
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/users" class="btn-modern btn-modern-outline w-100" style="border: 2px solid var(--gray-400); color: var(--gray-600);">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <!-- User Not Found -->
                    <div class="text-center p-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <h3 class="modern-card-title">User Not Found</h3>
                        <p class="modern-card-text mb-4">
                            The user you're trying to edit doesn't exist or has been deleted.
                        </p>
                        <a href="/users" class="btn-modern btn-modern-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to Users
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Actions Card -->
            <?php if (isset($user)): ?>
            <div class="modern-card mt-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body text-center">
                    <h5 class="modern-card-title">
                        <i class="fas fa-tools me-2"></i>
                        Other Actions
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/users/show?id=<?php echo $user['id']; ?>" class="btn btn-outline-info btn-sm w-100 mb-2">
                                <i class="fas fa-eye me-1"></i>
                                View Details
                            </a>
                        </div>
                        <div class="col-md-6">
                            <form method="POST" action="/users/delete" style="display: inline;" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" 
                                        class="btn btn-outline-danger btn-sm w-100"
                                        onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($user['username']); ?>?')">
                                    <i class="fas fa-trash me-1"></i>
                                    Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.user-edit-header {
    background: var(--gray-50);
    border-radius: var(--border-radius);
    padding: 1.5rem;
}

.user-avatar {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 1.5rem;
}

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editUserForm');
    if (form) {
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
    }
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>