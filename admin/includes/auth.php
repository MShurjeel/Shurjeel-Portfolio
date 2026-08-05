<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/flash.php';

/** Block access to a page unless an admin is logged in. */
function requireLogin(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

/** Send logged-in admins straight to the dashboard (used on login/register pages). */
function redirectIfLoggedIn(): void
{
    if (!empty($_SESSION['admin_id'])) {
        header('Location: dashboard.php');
        exit;
    }
}

/** Hash a plain-text password before it ever touches the database. */
function hashPassword(string $password): string
{
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

/** Compare a submitted password against the stored hash. */
function verifyPassword(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/** Cryptographically secure random token, used for password-reset links. */
function generateToken(): string
{
    return bin2hex(random_bytes(32));
}

/** Escape output safely. */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/** CSRF protection for every form in the admin panel. */
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrfToken()) . '">';
}

function verifyCsrf(): bool
{
    return isset($_POST['csrf_token'], $_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}
