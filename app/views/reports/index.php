<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-4">

    <!-- ✅ Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin Reports</li>
        </ol>
    </nav>

    <h2 class="text-primary mb-4">Admin Reports</h2>

    <!-- ✅ Charts Row -->
    <div class="row mb-4">
        <!-- Logins Bar Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-bar-chart-line me-1"></i> Total Logins by Users
                </div>
                <div class="card-body">
                    <canvas id="loginsChart" style="height:250px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Reminders Pie Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-pie-chart me-1"></i> Completed vs Pending Reminders
                </div>
                <div class="card-body">
                    <canvas id="remindersChart" style="height:250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

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

<!-- ✅ Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ✅ Total Logins Bar Chart
    const loginsCtx = document.getElementById('loginsChart').getContext('2d');
    new Chart(loginsCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($loginCounts, 'username')); ?>,
            datasets: [{
                label: 'Total Logins',
                data: <?= json_encode(array_column($loginCounts, 'total_logins')); ?>,
                backgroundColor: '#6c63ff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // ✅ Completed vs Pending Pie Chart
    const remindersData = <?= json_encode($allReminders); ?>;
    const completedCount = remindersData.filter(r => r.completed == 1).length;
    const pendingCount = remindersData.length - completedCount;

    const remindersCtx = document.getElementById('remindersChart').getContext('2d');
    new Chart(remindersCtx, {
        type: 'pie',
        data: {
            labels: ['Completed', 'Pending'],
            datasets: [{
                data: [completedCount, pendingCount],
                backgroundColor: ['#28a745', '#ffc107']
            }]
        },
        options: {
            responsive: true
        }
    });
