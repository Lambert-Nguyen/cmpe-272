<?php ob_start(); ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars($title); ?></h3>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($user)): ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?php echo date('F j, Y, g:i a', strtotime($user['created_at'])); ?></td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td><?php echo date('F j, Y, g:i a', strtotime($user['updated_at'])); ?></td>
                        </tr>
                    </table>
                    
                    <div class="d-grid gap-2">
                        <a href="/users/edit?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit User</a>
                        <a href="/users" class="btn btn-secondary">Back to Users</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">
                        User not found.
                    </div>
                    <a href="/users" class="btn btn-secondary">Back to Users</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>