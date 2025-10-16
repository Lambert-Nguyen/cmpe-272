<?php
ob_start();
?>

<div class="admin-users-page">
    <div class="container py-5">
        <!-- Header Section -->
        <div class="admin-header mb-4" data-aos="fade-down">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center mb-2">
                        <div class="secure-badge me-3">
                            <i class="fas fa-shield-halved fa-2x"></i>
                        </div>
                        <div>
                            <h1 class="mb-1">Secure Admin Section</h1>
                            <p class="text-muted mb-0">
                                <i class="fas fa-user-shield me-1"></i>
                                Logged in as: <strong><?php echo htmlspecialchars($admin_username); ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="/admin/logout" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $total_users; ?></h3>
                        <p>Total Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="stat-content">
                        <?php 
                        $activeCount = count(array_filter($users, function($u) { 
                            return $u['status'] === 'Active'; 
                        }));
                        ?>
                        <h3><?php echo $activeCount; ?></h3>
                        <p>Active Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="stat-content">
                        <?php 
                        $premiumCount = count(array_filter($users, function($u) { 
                            return $u['role'] === 'Premium User'; 
                        }));
                        ?>
                        <h3><?php echo $premiumCount; ?></h3>
                        <p>Premium Users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="users-table-card" data-aos="fade-up" data-aos-delay="400">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-list me-2"></i>Website Users Directory
                </h4>
                <p class="text-muted mb-0">
                    Complete list of registered users on the platform
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover modern-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    <i class="fas fa-user me-2"></i>Name
                                </th>
                                <th scope="col">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </th>
                                <th scope="col">
                                    <i class="fas fa-tag me-2"></i>Role
                                </th>
                                <th scope="col">
                                    <i class="fas fa-circle me-2"></i>Status
                                </th>
                                <th scope="col">
                                    <i class="fas fa-calendar me-2"></i>Join Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No users found.</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($users as $index => $user): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                                        </td>
                                        <td>
                                            <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" class="email-link">
                                                <?php echo htmlspecialchars($user['email']); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($user['role'] === 'Premium User'): ?>
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-crown me-1"></i>Premium
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-user me-1"></i>Standard
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($user['status'] === 'Active'): ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Active
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle me-1"></i>Inactive
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($user['join_date']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Info Alert -->
        <div class="alert alert-info mt-4" role="alert" data-aos="fade-up" data-aos-delay="500">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Note:</strong> This is a secure section accessible only to authenticated administrators. 
            User data is stored in a text file and loaded using PHP file operations.
        </div>
    </div>
</div>

<style>
.admin-users-page {
    padding-top: 100px;
    min-height: 100vh;
    background: linear-gradient(to bottom, #f7fafc 0%, #edf2f7 100%);
}

.admin-header {
    background: white;
    padding: 2rem;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.secure-badge {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: #2d3748;
}

.stat-content p {
    color: #718096;
    margin-bottom: 0;
}

.users-table-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.users-table-card .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem 2rem;
    border: none;
}

.users-table-card .card-body {
    padding: 0;
}

.modern-table {
    margin-bottom: 0;
}

.modern-table thead {
    background: #f7fafc;
}

.modern-table thead th {
    border: none;
    padding: 1rem 1.5rem;
    font-weight: 600;
    color: #4a5568;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.modern-table tbody td {
    padding: 1rem 1.5rem;
    vertical-align: middle;
    border-bottom: 1px solid #e2e8f0;
}

.modern-table tbody tr:last-child td {
    border-bottom: none;
}

.modern-table tbody tr:hover {
    background: #f7fafc;
}

.email-link {
    color: #667eea;
    text-decoration: none;
    transition: all 0.2s ease;
}

.email-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.badge {
    padding: 0.5rem 0.75rem;
    font-weight: 600;
    font-size: 0.75rem;
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
