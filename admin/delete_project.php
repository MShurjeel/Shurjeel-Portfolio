<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCsrf()) {
    setFlash('error', 'Invalid request.');
    header('Location: dashboard.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

if ($id > 0) {
    $stmt = $pdo->prepare('DELETE FROM projects WHERE id = ?');
    $stmt->execute([$id]);
    setFlash('success', 'Project deleted.');
} else {
    setFlash('error', 'Project not found.');
}

header('Location: dashboard.php');
exit;
