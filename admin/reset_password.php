<?php
require_once __DIR__ . '/includes/auth.php';
redirectIfLoggedIn();

$token = $_GET['token'] ?? ($_POST['token'] ?? '');
$errors = [];
$tokenValid = false;
$adminId = null;

if ($token === '') {
    $errors[] = 'Missing or invalid reset link.';
} else { 
    $stmt = $pdo->prepare(
        'SELECT id, admin_id, expires_at, used FROM password_resets WHERE token = ? LIMIT 1'
    );
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if (!$reset) {
        $errors[] = 'This reset link is invalid.';
    } elseif ((int) $reset['used'] === 1) {
        $errors[] = 'This reset link has already been used.';
    } elseif (strtotime($reset['expires_at']) < time()) {
        $errors[] = 'This reset link has expired. Please request a new one.';
    } else {
        $tokenValid = true;
        $adminId = (int) $reset['admin_id'];
    }
}

if ($tokenValid && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $errors[] = 'Your session expired. Please try again.';
    }

    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (mb_strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $hash = hashPassword($password);

        $pdo->prepare('UPDATE admins SET password_hash = ? WHERE id = ?')
            ->execute([$hash, $adminId]);

        $pdo->prepare('UPDATE password_resets SET used = 1 WHERE token = ?')
            ->execute([$token]);

        setFlash('success', 'Password updated. Please sign in with your new password.');
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password · Workfolio</title>
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
            <h1 class="auth-title">Reset Password</h1>
            <p class="auth-subtext">Choose a new password for your account</p>

            <?php if ($errors): ?>
                <div class="admin-alert alert-error">
                    <?php foreach ($errors as $err): ?>
                        <div><?= e($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($tokenValid): ?>
                <form method="POST" action="reset_password.php?token=<?= e($token) ?>" novalidate>
                    <?= csrfField() ?>
                    <input type="hidden" name="token" value="<?= e($token) ?>">
                    <div class="mb-3">
                        <label class="auth-label">New Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="passwordField" class="form-control auth-input"
                                   placeholder="At least 8 characters" required>
                            <i class="bi bi-eye-slash password-toggle" data-target="passwordField"></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="auth-label">Confirm New Password</label>
                        <div class="position-relative">
                            <input type="password" name="confirm_password" id="confirmField" class="form-control auth-input"
                                   placeholder="Re-enter password" required>
                            <i class="bi bi-eye-slash password-toggle" data-target="confirmField"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn auth-submit-btn w-100">Update Password</button>
                </form>
            <?php else: ?>
                <a href="forgot_password.php" class="btn auth-submit-btn w-100 d-block text-center">Request a new link</a>
            <?php endif; ?>

            <p class="auth-footer-text">
                <a href="login.php" class="auth-link"><i class="bi bi-arrow-left"></i> Back to login</a>
            </p>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
