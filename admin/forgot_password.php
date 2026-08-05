<?php
require_once __DIR__ . '/includes/auth.php';
redirectIfLoggedIn();

$errors = [];
$resetLink = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrf()) {
        $errors[] = 'Your session expired. Please try again.';
    }

    $email = trim($_POST['email'] ?? '');

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM admins WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $admin = $stmt->fetch();


        if ($admin) {
            // Invalidate any previous unused tokens for this admin.
            $pdo->prepare('DELETE FROM password_resets WHERE admin_id = ? AND used = 0')
                ->execute([$admin['id']]);

            $token     = generateToken();
            $expiresAt = date('Y-m-d H:i:s', time() + 3600); // 1 hour

            $pdo->prepare(
                'INSERT INTO password_resets (admin_id, token, expires_at) VALUES (?, ?, ?)'
            )->execute([$admin['id'], $token, $expiresAt]);
            
            $protocol  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host      = $_SERVER['HTTP_HOST'];
            $dir       = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $resetLink = "{$protocol}://{$host}{$dir}/reset_password.php?token=" . $token;


        }

        $formSubmitted = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password · Workfolio</title>
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
            <h1 class="auth-title">Forgot Password</h1>
            <p class="auth-subtext">Enter your email and we'll help you reset it</p>

            <?php if ($errors): ?>
                <div class="admin-alert alert-error">
                    <?php foreach ($errors as $err): ?>
                        <div><?= e($err) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($formSubmitted) && !$errors): ?>
                <div class="admin-alert alert-success">
                    If that email is registered, a reset link has been generated.
                </div>
                <?php if ($resetLink): ?>
                    <div class="reset-link-box">
                        <p class="reset-link-label">
                            <i class="bi bi-info-circle"></i>
                            Demo mode — no mail server configured, so here's your link directly:
                        </p>
                        <a href="<?= e($resetLink) ?>" class="reset-link"><?= e($resetLink) ?></a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <form method="POST" action="forgot_password.php" novalidate>
                    <?= csrfField() ?>
                    <div class="mb-4">
                        <label class="auth-label">Email</label>
                        <input type="email" name="email" class="form-control auth-input"
                               placeholder="you@example.com" required>
                    </div>
                    <button type="submit" class="btn auth-submit-btn w-100">Send Reset Link</button>
                </form>
            <?php endif; ?>

            <p class="auth-footer-text">
                <a href="login.php" class="auth-link"><i class="bi bi-arrow-left"></i> Back to login</a>
            </p>
        </div>
    </div>
    <script src="assets/js/admin.js"></script>
</body>
</html>
