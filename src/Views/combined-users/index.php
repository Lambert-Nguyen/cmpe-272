<?php ob_start(); ?>

<div class="combined-users-page">
    <div class="container">
        <!-- Page Header -->
        <div class="page-header text-center mb-5" data-aos="fade-up">
            <div class="icon-badge mx-auto mb-3">
                <i class="fas fa-network-wired fa-3x"></i>
            </div>
            <h1>Combined User List</h1>
            <p class="lead">All users from partner companies (CURL Integration)</p>
            <div class="badge bg-info mt-2">
                <i class="fas fa-link me-1"></i>Multi-Company Integration Lab
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-5" data-aos="fade-up">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $total_companies; ?></h3>
                        <p>Total Companies</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $active_companies; ?></h3>
                        <p>Active Connections</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $total_users; ?></h3>
                        <p>Combined Users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Companies and Their Users -->
        <?php foreach ($companies as $index => $company): ?>
        <div class="company-section mb-5" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
            <div class="company-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2>
                            <?php if ($company['source'] === 'local'): ?>
                                <i class="fas fa-home me-2 text-primary"></i>
                            <?php else: ?>
                                <i class="fas fa-globe me-2 text-info"></i>
                            <?php endif; ?>
                            <?php echo htmlspecialchars($company['name']); ?>
                        </h2>
                        <p class="company-url mb-0">
                            <i class="fas fa-link me-2"></i>
                            <a href="<?php echo htmlspecialchars($company['url']); ?>" target="_blank">
                                <?php echo htmlspecialchars($company['url']); ?>
                            </a>
                        </p>
                    </div>
                    <div class="company-badge">
                        <?php if ($company['status'] === 'success'): ?>
                            <span class="badge bg-success badge-lg">
                                <i class="fas fa-check-circle me-1"></i>
                                <?php echo count($company['users']); ?> Users
                            </span>
                            <?php if ($company['source'] === 'local'): ?>
                                <span class="badge bg-primary badge-lg ms-2">
                                    <i class="fas fa-database me-1"></i>Local DB
                                </span>
                            <?php elseif ($company['source'] === 'manual'): ?>
                                <span class="badge bg-warning badge-lg ms-2">
                                    <i class="fas fa-hand-paper me-1"></i>Manual Entry
                                </span>
                            <?php else: ?>
                                <span class="badge bg-info badge-lg ms-2">
                                    <i class="fas fa-exchange-alt me-1"></i>CURL
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="badge bg-danger badge-lg">
                                <i class="fas fa-exclamation-triangle me-1"></i>Connection Failed
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($company['status'] === 'success' && !empty($company['users'])): ?>
                <!-- Users Table -->
                <div class="company-body">
                    <div class="table-responsive">
                        <table class="table table-hover modern-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><i class="fas fa-user me-2"></i>Name</th>
                                    <th><i class="fas fa-envelope me-2"></i>Email</th>
                                    <th><i class="fas fa-tag me-2"></i>Role</th>
                                    <th><i class="fas fa-circle me-2"></i>Status</th>
                                    <th><i class="fas fa-calendar me-2"></i>Join Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($company['users'] as $userIndex => $user): ?>
                                <tr>
                                    <td><?php echo $userIndex + 1; ?></td>
                                    <td><strong><?php echo htmlspecialchars($user['name']); ?></strong></td>
                                    <td>
                                        <?php if (isset($user['email']) && $user['email'] !== 'N/A'): ?>
                                            <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" class="email-link">
                                                <?php echo htmlspecialchars($user['email']); ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $role = $user['role'] ?? 'Member';
                                        if (strpos($role, 'Premium') !== false): 
                                        ?>
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-crown me-1"></i>Premium
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-briefcase me-1"></i><?php echo htmlspecialchars($role); ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $status = $user['status'] ?? 'Active';
                                        if ($status === 'Active'): 
                                        ?>
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times-circle me-1"></i>Inactive
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($user['join_date'] ?? date('Y-m-d')); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($company['status'] === 'error'): ?>
                <!-- Error Message -->
                <div class="company-body">
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Connection Error</h5>
                        <p class="mb-0">
                            <strong>Error:</strong> <?php echo htmlspecialchars($company['error_message'] ?? 'Unknown error'); ?>
                        </p>
                        <?php if (isset($company['http_code'])): ?>
                        <p class="mb-0 mt-2">
                            <strong>HTTP Code:</strong> <?php echo $company['http_code']; ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <!-- Empty State -->
                <div class="company-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i>No users found for this company.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <!-- Technical Info Box -->
        <div class="info-box" data-aos="fade-up">
            <div class="row">
                <div class="col-md-8">
                    <h4><i class="fas fa-code me-2"></i>How Multi-Company Integration Works</h4>
                    <p class="mb-2">
                        <strong>Local Data:</strong> Fetched directly from local database using PHP file operations.
                    </p>
                    <p class="mb-2">
                        <strong>Remote Data (CURL):</strong> Retrieved from partner companies using PHP CURL requests to their API endpoints.
                    </p>
                    <p class="mb-2">
                        <strong>Manual Entry:</strong> For services with anti-bot protection (like 42web.io free hosting), data is manually copied from the partner's API response and entered into the controller.
                    </p>
                    <p class="mb-0">
                        <strong>API Endpoint:</strong> <code><?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?>/api/users</code>
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="/api/users" class="btn btn-outline-primary" target="_blank">
                        <i class="fas fa-code me-2"></i>View API Response
                    </a>
                </div>
            </div>
        </div>

        <!-- Configuration Box -->
        <?php if (empty($partner_urls)): ?>
        <div class="alert alert-info mt-4" role="alert" data-aos="fade-up">
            <h5><i class="fas fa-info-circle me-2"></i>Configuration Required</h5>
            <p class="mb-2">
                To display users from partner companies, add their API URLs in 
                <code>src/Controllers/CombinedUsersController.php</code>:
            </p>
            <pre class="bg-light p-3 rounded mt-2"><code>$partnerCompanies = [
    'Company B' => 'https://company-b.com/api/users',
    'Company C' => 'https://company-c.com/api/users',
];</code></pre>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.combined-users-page {
    padding-top: 100px;
    padding-bottom: 60px;
    background: linear-gradient(to bottom, #f7fafc 0%, #edf2f7 100%);
    min-height: 100vh;
}

.icon-badge {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.page-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 15px;
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

.company-section {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.company-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
}

.company-header h2 {
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.company-url a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
}

.company-url a:hover {
    color: white;
    text-decoration: underline;
}

.badge-lg {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    font-weight: 600;
}

.company-body {
    padding: 2rem;
}

.modern-table {
    margin-bottom: 0;
}

.modern-table thead {
    background: #f7fafc;
}

.modern-table thead th {
    border: none;
    padding: 1rem;
    font-weight: 600;
    color: #4a5568;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.modern-table tbody td {
    padding: 1rem;
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
}

.email-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.info-box {
    background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
    border: 2px solid #667eea30;
    padding: 2rem;
    border-radius: 12px;
}

.info-box h4 {
    color: #2d3748;
    font-weight: 600;
    margin-bottom: 1rem;
}

.info-box code {
    background: #2d3748;
    color: #a9f5d1;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9rem;
}

pre code {
    color: #2d3748;
}

@media (max-width: 768px) {
    .company-header {
        text-align: center;
    }
    
    .company-badge {
        margin-top: 1rem;
    }
    
    .info-box {
        text-align: center;
    }
    
    .info-box .btn {
        margin-top: 1rem;
        width: 100%;
    }
}
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
