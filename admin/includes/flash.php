<?php
/** Store a one-time message ('success' | 'error') to show after a redirect. */
function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

/** Retrieve + clear the flash message, if any. */
function getFlash(): ?array
{
    if (!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/** Render the flash banner markup (call inside your HTML). */
function renderFlash(): void
{
    $flash = getFlash();
    if (!$flash) {
        return;
    }
    $type = $flash['type'] === 'success' ? 'alert-success' : 'alert-error';
    echo '<div class="admin-alert ' . $type . '" id="flashAlert">' . e($flash['message']) . '</div>';
}
