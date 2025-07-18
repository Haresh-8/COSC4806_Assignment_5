<?php
// Determine the current controller or page
$currentPage = $_SESSION['controller'] ?? '';

// Show footer only if NOT on login or welcome page
if (!in_array($currentPage, ['login', 'welcome'])):
?>
<footer class="footer mt-auto py-4 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">

            <!-- Left: Brand & Year -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="fw-bold text-uppercase">COSC 4806</h5>
                <p class="mb-0">&copy; <?= date('Y'); ?> All Rights Reserved.</p>
            </div>

            <!-- Middle: Quick Links (Horizontal) -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h6 class="text-uppercase fw-bold text-center text-md-start">Quick Links</h6>
                <div class="d-flex justify-content-center justify-content-md-start flex-wrap gap-3 mt-2">
                    <a href="/home" class="text-decoration-none text-white-50 footer-link">Home</a>
                    <a href="/reminder" class="text-decoration-none text-white-50 footer-link">Reminders</a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="/reports" class="text-decoration-none text-white-50 footer-link">Reports</a>
                    <?php endif; ?>
                    <a href="/logout" class="text-decoration-none text-white-50 footer-link">Logout</a>
                </div>
            </div>

            <!-- Right: Contact / Support -->
            <div class="col-md-4 text-md-end">
                <h6 class="text-uppercase fw-bold">Contact</h6>
                <p class="mb-1"><i class="bi bi-envelope-fill me-1"></i> harepatel@algomau.ca</p>
            </div>
        </div>

        <hr class="border-secondary my-3">

        <!-- Bottom Note -->
        <div class="text-center small text-white-50">
            Designed by Hareshkumar Patel
        </div>
    </div>
</footer>
<?php endif; ?>

<!-- Hover effect -->
<style>
.footer-link:hover {
    color: #fff !important;
    text-decoration: underline;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
        crossorigin="anonymous"></script>
</body>
</html>
