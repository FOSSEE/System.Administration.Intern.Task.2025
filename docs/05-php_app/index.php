<?php

declare(strict_types=1);

require __DIR__ . '/auth.php';
$isAuthed = isset($_SESSION['user']) && !empty($_SESSION['user']['sub']);
include("template.php");

?>

<div class="container mt-5">
    <h2>Home</h2>
    <?php if ($isAuthed): ?>
        <h5>Welcome, <span class="text-info"><?= htmlspecialchars($_SESSION['user']['name'] ?? $_SESSION['user']['username'] ?? 'user', ENT_QUOTES) ?></span>! to the PHP App</h5>
    <?php else: ?>
        <h5>You are not logged in. Please log in with Keycloak.</h5>
    <?php endif; ?>
</div>