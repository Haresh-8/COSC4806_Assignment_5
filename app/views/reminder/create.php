<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-5">
    <h2>Create Reminder</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="/reminder" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
