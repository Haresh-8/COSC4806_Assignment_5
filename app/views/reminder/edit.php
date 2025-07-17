<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-5">
    <h2>Edit Reminder</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" value="<?= htmlspecialchars($data['reminder']['subject']) ?>" class="form-control" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="completed" id="completed" <?= $data['reminder']['completed'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="completed">Completed</label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/reminder" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
