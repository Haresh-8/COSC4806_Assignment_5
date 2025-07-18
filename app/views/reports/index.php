<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-4">

    <h2 class="text-primary mb-4">Admin Reports</h2>

    <!-- ✅ Total Logins Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-person-lines-fill me-1"></i> Total Logins Table
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Total Logins</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($loginCounts)): ?>
                        <?php foreach ($loginCounts as $login): ?>
                            <tr>
                                <td><?= htmlspecialchars($login['username']); ?></td>
                                <td><span class="badge bg-success"><?= $login['total_logins']; ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center text-muted">No login data available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ All Reminders Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-list-check me-1"></i> All Reminders
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Subject</th>
                        <th>Completed</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($allReminders)): ?>
                        <?php foreach ($allReminders as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['username']); ?></td>
                                <td><?= htmlspecialchars($r['subject']); ?></td>
                                <td>
                                    <?= $r['completed']
                                        ? '<span class="badge bg-success">Yes</span>'
                                        : '<span class="badge bg-danger">No</span>'; ?>
                                </td>
                                <td><?= $r['created_at']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No reminders available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ✅ Top User -->
    <div class="alert alert-info mt-3 shadow-sm">
        <strong><i class="bi bi-trophy me-1"></i> Top User:</strong>
        <?= htmlspecialchars($topUser['username']); ?> with <?= $topUser['total_reminders']; ?> reminders.
    </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
