<?php ob_start(); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Page Header -->
            <div class="text-center mb-4" data-aos="fade-down">
                <h1 class="text-gradient"><?php echo htmlspecialchars($title); ?></h1>
                <p class="text-muted">Complete user information and details</p>
            </div>

            <!-- Error Alert -->
            <?php if (isset($error)): ?>
                <div class="modern-alert modern-alert-danger" data-aos="fade-in">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($user)): ?>
                <!-- User Profile Card -->
                <div class="modern-card mb-4" data-aos="fade-up">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <!-- User Avatar -->
                                <div class="user-profile-avatar mb-3">
                                    <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
                                </div>
                                <h4 class="modern-card-title"><?php echo htmlspecialchars($user['username']); ?></h4>
                                <p class="text-muted">
                                    <i class="fas fa-envelope me-1"></i>
                                    <?php echo htmlspecialchars($user['email']); ?>
                                </p>
                                <div class="user-badge">
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="fas fa-hashtag me-1"></i>ID: <?php echo $user['id']; ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-md-8">
                                <h5 class="modern-card-title mb-4">
                                    <i class="fas fa-info-circle me-2"></i>User Information
                                </h5>
                                
                                <div class="user-details">
                                    <div class="detail-row">
                                        <div class="detail-label">
                                            <i class="fas fa-user text-primary"></i>
                                            Username
                                        </div>
                                        <div class="detail-value">
                                            <?php echo htmlspecialchars($user['username']); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-row">
                                        <div class="detail-label">
                                            <i class="fas fa-envelope text-success"></i>
                                            Email Address
                                        </div>
                                        <div class="detail-value">
                                            <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" 
                                               class="text-decoration-none">
                                                <?php echo htmlspecialchars($user['email']); ?>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-row">
                                        <div class="detail-label">
                                            <i class="fas fa-calendar-plus text-info"></i>
                                            Created Date
                                        </div>
                                        <div class="detail-value">
                                            <span class="date-highlight">
                                                <?php echo date('F j, Y', strtotime($user['created_at'])); ?>
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                at <?php echo date('g:i A', strtotime($user['created_at'])); ?>
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="detail-row">
                                        <div class="detail-label">
                                            <i class="fas fa-clock text-warning"></i>
                                            Last Updated
                                        </div>
                                        <div class="detail-value">
                                            <span class="date-highlight">
                                                <?php echo date('F j, Y', strtotime($user['updated_at'])); ?>
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                at <?php echo date('g:i A', strtotime($user['updated_at'])); ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-center mb-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="/users/edit?id=<?php echo $user['id']; ?>" class="btn-modern btn-modern-primary">
                        <i class="fas fa-edit me-2"></i>
                        Edit User
                    </a>
                    <a href="/users" class="btn-modern btn-modern-secondary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Users
                    </a>
                </div>

                <!-- Additional Info Cards -->
                <div class="row" data-aos="fade-up" data-aos-delay="300">
                    <div class="col-md-6">
                        <div class="modern-card">
                            <div class="card-body text-center p-4">
                                <div class="info-icon mb-3">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h5 class="modern-card-title">Account Status</h5>
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    <i class="fas fa-check me-1"></i>Active
                                </span>
                                <p class="text-muted mt-2 mb-0">
                                    Account is active and in good standing
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="modern-card">
                            <div class="card-body text-center p-4">
                                <div class="info-icon mb-3">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h5 class="modern-card-title">Account Age</h5>
                                <div class="fs-4 text-gradient fw-bold">
                                    <?php 
                                    $created = new DateTime($user['created_at']);
                                    $now = new DateTime();
                                    $diff = $now->diff($created);
                                    
                                    if ($diff->days > 0) {
                                        echo $diff->days . ' day' . ($diff->days > 1 ? 's' : '');
                                    } else {
                                        echo 'Today';
                                    }
                                    ?>
                                </div>
                                <p class="text-muted mt-2 mb-0">
                                    Since registration
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="modern-card border-danger mt-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-body p-4">
                        <h5 class="text-danger mb-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Danger Zone
                        </h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Delete this user</h6>
                                <p class="text-muted mb-0">
                                    Once you delete this user, there is no going back. Please be certain.
                                </p>
                            </div>
                            <form method="POST" action="/users/delete" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <button type="submit" 
                                        class="btn btn-outline-danger"
                                        onclick="return confirm('⚠️ Are you absolutely sure you want to delete <?php echo htmlspecialchars($user['username']); ?>?\n\nThis action cannot be undone!')">
                                    <i class="fas fa-trash me-1"></i>
                                    Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- User Not Found -->
                <div class="modern-card text-center" data-aos="fade-up">
                    <div class="card-body p-5">
                        <div class="display-1 text-muted mb-4">
                            <i class="fas fa-user-slash"></i>
                        </div>
                        <h3 class="modern-card-title">User Not Found</h3>
                        <p class="modern-card-text mb-4">
                            The user you're looking for doesn't exist or has been deleted.
                        </p>
                        <a href="/users" class="btn-modern btn-modern-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Back to Users
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.user-profile-avatar {
    width: 100px;
    height: 100px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 2.5rem;
    margin: 0 auto;
    box-shadow: var(--shadow-lg);
}

.user-badge {
    margin-top: 1rem;
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 1rem;
    background: var(--gray-50);
    border-radius: var(--border-radius);
    border-left: 4px solid var(--primary-color);
    transition: all 0.3s ease;
}

.detail-row:hover {
    background: white;
    box-shadow: var(--shadow-sm);
}

.detail-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    color: var(--gray-700);
    min-width: 140px;
}

.detail-label i {
    font-size: 1.1rem;
}

.detail-value {
    text-align: right;
    color: var(--gray-800);
}

.date-highlight {
    font-weight: 600;
    color: var(--primary-color);
}

.info-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto;
}

.border-danger {
    border: 2px solid var(--error) !important;
    background: rgba(239, 68, 68, 0.05);
}

@media (max-width: 768px) {
    .detail-row {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .detail-label {
        min-width: auto;
    }
    
    .detail-value {
        text-align: left;
    }
    
    .user-profile-avatar {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>