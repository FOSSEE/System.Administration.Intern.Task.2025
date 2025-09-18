<?php

declare(strict_types=1);
session_start();
$config = require __DIR__ . '/config.php';

$idToken = $_SESSION['id_token'] ?? null;
$issuer  = rtrim($config['KEYCLOAK_BASE_URL'], '/') . '/realms/' . $config['REALM'];
$postLogout = $config['APP_URL'] . '/';

session_unset();
session_destroy();

$logoutUrl = $issuer . '/protocol/openid-connect/logout'
    . '?post_logout_redirect_uri=' . urlencode($postLogout);


if ($idToken) {
    $logoutUrl .= '&id_token_hint=' . urlencode($idToken);
}

header('Location: ' . $logoutUrl);
exit;
