<?php
require_once __DIR__ . '/includes/auth.php';
redirectIfLoggedIn();

$errors = [];
$old = ['email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $errors[] = 'Your session expired. Please try again.';
    }

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $old['email'] = $email;

    if ($email === '' || $password === '') {
        $errors[] = 'Please enter both email and password.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($errors)) {
        // Updated to include profile_image in the query
        $stmt = $pdo->prepare('SELECT id, full_name, password_hash, profile_image FROM admins WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if (!$admin || !verifyPassword($password, $admin['password_hash'])) {
            $errors[] = 'Incorrect email or password.';
        } else {
            session_regenerate_id(true);
            $_SESSION['admin_id']    = $admin['id'];
            $_SESSION['admin_name']  = $admin['full_name'];
            $_SESSION['admin_image'] = $admin['profile_image'] ?? null; 
            setFlash('success', 'Welcome back, ' . $admin['full_name'] . '.');
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login · Workfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body class="auth-page">
    <div class="auth-wrapper">
        <div class="auth-card fade-up">
            <div class="auth-logo">
                <div class="logo-box">W</div>
                <p class="logo-text">Workfolio</p>
            </div>
            <h1 class="auth-title">Admin Login</h1>
            <p class="auth-subtext">Sign in to manage your portfolio</p>

            <?php if ($errors): ?>
                <div class="admin-alert alert-error">
                    <?php foreach ($errors as $err): ?>
                        <div><?= e($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php renderFlash(); ?>

            <form method="POST" action="login.php" novalidate>
                <?= csrfField() ?>
                <div class="mb-3">
                    <label class="auth-label">Email</label>
                    <input type="email" name="email" class="form-control auth-input"
                           placeholder="you@example.com" value="<?= e($old['email']) ?>" required>
                </div>
                <div class="mb-2">
                    <label class="auth-label">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="passwordField" class="form-control auth-input"
                               placeholder="Enter your password" required>
                        <i class="bi bi-eye-slash password-toggle" data-target="passwordField"></i>
                    </div>
                </div>
                <div class="text-end mb-4">
                    <a href="forgot_password.php" class="auth-link-small">Forgot password?</a>
                </div>
                <button type="submit" class="btn auth-submit-btn w-100">Sign In</button>
            </form>

            <p class="auth-footer-text">
                Don't have an account? <a href="register.php" class="auth-link">Register</a>
            </p>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
