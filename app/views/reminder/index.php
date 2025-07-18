<?php require_once 'app/views/templates/header.php'; ?>

<div class="container mt-4">

    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Reminders</li>
        </ol>
    </nav>

    <h2 class="mb-3">Your Reminders</h2>
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




    <!-- Reminders Table -->
    <table class="table table-striped table-hover shadow-sm">
        <thead class="table-light">
            <tr>
                <th>Subject</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['reminders'])): ?>
                <?php foreach ($data['reminders'] as $reminder): ?>
                    <tr>
                        <td><?= htmlspecialchars($reminder['subject']) ?></td>
                        <td>
                            <?php if ($reminder['completed']): ?>
                                <span class="badge bg-success">Done</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="/reminder/edit/<?= $reminder['id'] ?>" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="/reminder/delete/<?= $reminder['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Delete this reminder?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center text-muted">No reminders found. Start by creating one!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
