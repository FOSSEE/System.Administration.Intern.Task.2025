<?php

declare(strict_types=1);
session_start();
require __DIR__ . '/vendor/autoload.php';

use Jumbojett\OpenIDConnectClient;

$config = require __DIR__ . '/config.php';
$issuer = rtrim($config['KEYCLOAK_BASE_URL'], '/') . '/realms/' . $config['REALM'];

$oidc = new OpenIDConnectClient(
    $issuer,
    $config['CLIENT_ID'],
    $config['CLIENT_SECRET']
);

$oidc->setRedirectURL($config['APP_URL'] . $config['REDIRECT_PATH']);
$oidc->setResponseTypes(['code']);        // Authorization Code Flow
$oidc->addScope(['openid', 'profile', 'email']);

$oidc->authenticate();
