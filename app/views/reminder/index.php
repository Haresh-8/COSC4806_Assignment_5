<?php require_once 'app/views/templates/header.php'; ?>

<style>
    .completed-reminder {
        
        opacity: 0.6;
        transition: all 0.5s ease-in-out;
    }
</style>

<div class="container mt-4">
    <h2>Your Reminders</h2>

    <?php date_default_timezone_set("America/Toronto"); ?>
    <p class="lead" id="toronto-time">
        <?= date("F jS, Y") ?> - <?= date("h:i:s A") ?>
    </p>

    <script>
      function updateTorontoTime() {
        const options = {
          timeZone: 'America/Toronto',
          year: 'numeric',
          month: 'long',
          day: 'numeric',
          hour: '2-digit',
          minute: '2-digit',
          second: '2-digit',
          hour12: true
        };
        const formatter = new Intl.DateTimeFormat([], options);
        document.getElementById('toronto-time').textContent = formatter.format(new Date());
      }

      // Update every second
      setInterval(updateTorontoTime, 1000);
      updateTorontoTime(); // initial call so time shows immediately
    </script>



    <table class="table table-striped">
        <thead>
            <tr><th>Subject</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($data['reminders'] as $reminder): ?>
                <tr>
                    <td class="<?= $reminder['completed'] ? 'completed-reminder text-muted' : '' ?>">
                        <?= htmlspecialchars($reminder['subject']) ?>
                    </td>
                    <td><?= $reminder['completed'] ? 'Done' : 'Pending' ?></td>
                    <td>
                        <a href="/reminder/edit/<?= $reminder['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/reminder/delete/<?= $reminder['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this reminder?')">Delete</a>

                        <?php if (!$reminder['completed']): ?>
                            <form method="POST" action="/reminder/complete/<?= $reminder['id'] ?>" style="display:inline;">
                                <button type="submit" class="btn btn-sm btn-success">Mark as Done</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="/home" class="btn btn-secondary mb-3">← Back to Home</a>
    <a href="/reminder/create" class="btn btn-success mb-3">+ Add Reminder</a>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
