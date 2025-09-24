<?php ob_start(); ?>

<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h1 class="text-gradient mb-2"><?php echo htmlspecialchars($title); ?></h1>
            <p class="text-muted">Manage users with full CRUD operations</p>
        </div>
        <a href="/users/create" class="btn-modern btn-modern-primary">
            <i class="fas fa-plus"></i>
            Add New User
        </a>
    </div>

    <!-- Error Alert -->
    <?php if (isset($error)): ?>
        <div class="modern-alert modern-alert-danger" data-aos="fade-in">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- Empty State -->
    <?php if (empty($users)): ?>
        <div class="modern-card text-center" data-aos="fade-up">
            <div class="card-body p-5">
                <div class="display-1 text-muted mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="modern-card-title">No Users Found</h3>
                <p class="modern-card-text mb-4">
                    Get started by creating your first user account.
                </p>
                <a href="/users/create" class="btn-modern btn-modern-primary">
                    <i class="fas fa-plus"></i>
                    Create First User
                </a>
            </div>
        </div>
    <?php else: ?>
        <!-- Users Table -->
        <div class="modern-table-container" data-aos="fade-up">
            <table class="table modern-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag me-2"></i>ID</th>
                        <th><i class="fas fa-user me-2"></i>Username</th>
                        <th><i class="fas fa-envelope me-2"></i>Email</th>
                        <th><i class="fas fa-calendar me-2"></i>Created</th>
                        <th><i class="fas fa-cog me-2"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr data-aos="fade-up" data-aos-delay="<?php echo array_search($user, $users) * 50; ?>">
                        <td>
                            <span class="badge bg-primary rounded-pill"><?php echo htmlspecialchars($user['id']); ?></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-placeholder me-3">
                                    <?php echo strtoupper(substr($user['username'], 0, 2)); ?>
                                </div>
                                <strong><?php echo htmlspecialchars($user['username']); ?></strong>
                            </div>
                        </td>
                        <td>
                            <i class="fas fa-envelope text-muted me-2"></i>
                            <?php echo htmlspecialchars($user['email']); ?>
                        </td>
                        <td>
                            <span class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="/users/show?id=<?php echo $user['id']; ?>" 
                                   class="btn btn-sm btn-outline-info" 
                                   data-bs-toggle="tooltip" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/users/edit?id=<?php echo $user['id']; ?>" 
                                   class="btn btn-sm btn-outline-warning"
                                   data-bs-toggle="tooltip" 
                                   title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="/users/delete" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger" 
                                            data-bs-toggle="tooltip" 
                                            title="Delete User"
                                            onclick="return confirm('Are you sure you want to delete <?php echo htmlspecialchars($user['username']); ?>?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Summary Card -->
        <div class="modern-card mt-4" data-aos="fade-up">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="display-6 text-gradient">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="mt-2"><?php echo count($users); ?></h5>
                        <p class="text-muted">Total Users</p>
                    </div>
                    <div class="col-md-4">
                        <div class="display-6 text-gradient">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h5 class="mt-2">CRUD</h5>
                        <p class="text-muted">Operations</p>
                    </div>
                    <div class="col-md-4">
                        <div class="display-6 text-gradient">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="mt-2">Secure</h5>
                        <p class="text-muted">Database</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.avatar-placeholder {
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 0.8rem;
}

.btn-group .btn {
    margin-right: 0.25rem;
    border-radius: 6px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.badge {
    font-size: 0.75rem;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>