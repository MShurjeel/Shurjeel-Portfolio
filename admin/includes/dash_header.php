<?php

$activeNav = $activeNav ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' · ' : '' ?>Admin · Workfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body class="dashboard-body">
    <div class="dashboard-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <div class="logo-box">W</div>
                <p class="logo-text">Workfolio</p>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="sidebar-link <?= $activeNav === 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-grid"></i> Dashboard
                </a>
                <a href="dashboard.php" class="sidebar-link <?= $activeNav === 'projects' ? 'active' : '' ?>">
                    <i class="bi bi-kanban"></i> Projects
                </a>
                <a href="../index.php" target="_blank" class="sidebar-link">
                    <i class="bi bi-box-arrow-up-right"></i> View Site
                </a>
            </nav>
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link logout-link">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </aside>

        <div class="dashboard-main">
            <header class="topbar">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="topbar-title"><?= isset($pageTitle) ? e($pageTitle) : 'Dashboard' ?></h1>
                <div class="topbar-admin">
                    <?php if (!empty($_SESSION['admin_image'])): ?>
                        <!-- Agar profile image DB mein hai, wahi dikhao -->
                        <img src="<?= e($_SESSION['admin_image']) ?>" alt="Admin" class="admin-avatar-img">
                    <?php else: ?>
                        <!-- Warna purana letter-based avatar fallback ke taur pe -->
                        <span class="admin-avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)) ?></span>
                    <?php endif; ?>
                    <span class="admin-name"><?= e($_SESSION['admin_name'] ?? 'Admin') ?></span>
                </div>
            </header>
            <main class="dashboard-content fade-up">
                <?php renderFlash(); ?>