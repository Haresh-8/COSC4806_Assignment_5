<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-4">
    <!--Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/reminder">Reminders</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Reminder</li>
        </ol>
    </nav>

    <h2 class="text-primary mb-4">Create Reminder</h2>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label fw-bold">Subject</label>
            <input type="text" name="subject" class="form-control" placeholder="Enter reminder subject" required>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Create
        </button>
        <a href="/reminder" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Cancel
        </a>
    </form>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
