<?php

declare(strict_types=1);
require __DIR__ . '/auth.php';

$isAuthed = isset($_SESSION['user']) && !empty($_SESSION['user']['sub']);

include("template.php");

$accessToken = getAccessToken();

if (!$accessToken) {
    header("Location: login.php");
    exit;
}
?>

<div class="container mt-5">
    <h2>Profile</h2>
    <div class="bg-black p-2 my-2">
        <ul>
            <li><strong>Username:</strong> <?= htmlspecialchars($_SESSION['user']['username']) ?></li>
            <li><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></li>
            <li><strong>Subject (sub):</strong> <?= htmlspecialchars($_SESSION['user']['sub']) ?></li>
        </ul>
    </div>
    <h3>Token Info</h3>
    <div class="bg-black p-2 my-2">
        <strong>Access Token Expires in: </strong><?= $_SESSION['expires_at'] - time() ?> sec
    </div>
    <h3>Realm Roles</h3>
    <div class="bg-black p-2 my-2">
        <pre><?php echo htmlspecialchars(json_encode($_SESSION['realm_roles'], JSON_PRETTY_PRINT)); ?></pre>
    </div>
    <h3>Resource Access</h3>
    <div class="bg-black p-2 my-2">
        <pre><?php echo htmlspecialchars(json_encode($_SESSION['resource_access'], JSON_PRETTY_PRINT)); ?></pre>
    </div>
    <h3>ID Token Claims</h3>
    <div class="bg-black p-2 my-2">
        <pre><?php echo htmlspecialchars(json_encode($_SESSION['id_token_claims'], JSON_PRETTY_PRINT)); ?></pre>
    </div>
    <h3>Access Token Claims</h3>
    <div class="bg-black p-2 my-2">
        <pre><?php echo htmlspecialchars(json_encode($_SESSION['access_token_claims'], JSON_PRETTY_PRINT)); ?></pre>
    </div>
</div>

</div>