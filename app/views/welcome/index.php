<?php require_once 'app/views/templates/headerPublic.php'; ?>

        <div class="container text-center mt-5">
            
            <div class="mt-4">
                <div class="container text-center mt-5">
                    <h1 class="display-4 fw-bold text-primary">
                        🎓 COSC4806: Smart Reminder App 🎓
                    </h1>
                    <p class="lead text-muted mb-4">
                        Your personalized login and reminder management system
                    </p>
                </div>
            </div>
        <!-- Action Buttons -->
        <div class="mt-4">
            <a class="btn btn-primary btn-lg px-4 m-2" href="/login">
                <i class="bi bi-box-arrow-in-right me-2"></i> Existing User? Login
            </a>
            <a class="btn btn-success btn-lg px-4 m-2" href="/create">
                <i class="bi bi-person-plus-fill me-2"></i> New User? Register
            </a>
        </div>
    </div>
</div>
 <div class="container text-center mt-5">
  <!-- Live Toronto Time -->
    <div class="mt-3">
        <p class="lead" id="user-time"></p>
    </div>

    <!-- Alert Section -->
    <div class="alert alert-info mt-4" role="alert">
        You must be logged in to access reminders.
    </div>
</div>

<!-- Live Toronto Time Script -->
<script>
    function updateUserTime() {
        const now = new Date();
        const formatted = now.toLocaleString(undefined, {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        });
        document.getElementById('user-time').textContent = formatted;
    }
    setInterval(updateUserTime, 1000); // update every second
    updateUserTime(); // initial call
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
