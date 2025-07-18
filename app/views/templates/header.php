<?php
// ✅ Redirect if not logged in
if (!isset($_SESSION['auth'])) {
    header('Location: /welcome');
    exit;
}

// ✅ Current controller (for active menu highlight)
$currentController = $_SESSION['controller'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>COSC 4806</title>
    <link rel="icon" href="/favicon.png" />

    <!-- ✅ Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* ✅ Navbar Customization */
        .navbar {
            background: linear-gradient(90deg, #0d6efd, #0a58ca);
        }
        .navbar-brand {
            font-size: 1.4rem;
            letter-spacing: 0.5px;
        }
        .navbar .nav-link {
            transition: color 0.3s ease, transform 0.2s ease;
        }
        .navbar .nav-link:hover {
            color: #ffc107 !important;
            transform: translateY(-2px);
        }
        .navbar .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
        }
        .navbar .username {
            font-weight: 600;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid">
        <!-- ✅ Brand -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/home">
            <i class="bi bi-journal-check me-2"></i> COSC 4806
        </a>

        <!-- ✅ Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- ✅ Left Menu -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'home') ? ' active' : '' ?>" href="/home">
                        <i class="bi bi-house-door me-1"></i> Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'reminder') ? ' active' : '' ?>" href="/reminder">
                        <i class="bi bi-list-check me-1"></i> My Reminders
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/reminder/create">
                        <i class="bi bi-plus-circle me-1"></i> Create Reminder
                    </a>
                </li>

                <!-- ✅ Admin Reports (Only for Admin) -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'reports') ? ' active' : '' ?>" href="/reports">
                            <i class="bi bi-shield-lock me-1"></i> Admin Reports
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Right Menu -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text text-white me-3 username">
                        <i class="bi bi-person-circle me-1"></i>
                        <?= htmlspecialchars($_SESSION['username']); ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning fw-bold" href="/logout">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
