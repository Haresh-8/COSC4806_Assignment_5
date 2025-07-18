<?php require_once 'app/views/templates/header.php' ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #e0f7fa, #e1f5fe);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .welcome-box {
        max-width: 750px;
        margin: auto;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        padding: 45px;
        text-align: center;
        animation: fadeIn 0.5s ease-in-out;
    }
    .welcome-box h1 {
        color: #007bff;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .stats-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stats-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    .stats-box i {
        font-size: 3rem;
        margin-bottom: 5px;
    }
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(10px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>

<div class="container my-5">
    <div class="welcome-box">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</h1>
        <p class="lead">You are now logged in and ready to manage your reminders efficiently.</p>
        <p class="text-muted"><?= date("F jS, Y"); ?></p>

        <hr class="my-4">

        <!-- User Quick Stats -->
        <div class="row text-center">
            <div class="col-md-6 mb-3">
                <div class="stats-box">
                    <i class="bi bi-list-check text-primary"></i>
                    <h5 class="mt-2">Total Reminders</h5>
                    <p class="fw-bold display-6"><?= $data['totalReminders'] ?? 0; ?></p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="stats-box">
                    <i class="bi bi-check2-circle text-success"></i>
                    <h5 class="mt-2">Completed Tasks</h5>
                    <p class="fw-bold display-6"><?= $data['completedReminders'] ?? 0; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once 'app/views/templates/footer.php' ?>
