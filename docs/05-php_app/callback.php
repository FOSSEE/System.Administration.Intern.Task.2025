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
$oidc->setResponseTypes(['code']);
$oidc->addScope(['openid', 'profile', 'email']);


$oidc->authenticate();


$idToken     = $oidc->getIdToken();
$accessToken = $oidc->getAccessToken();
$refreshToken = $oidc->getRefreshToken();


function base64url_decode(string $data): string
{
    return base64_decode(strtr($data, '-_', '+/')) ?: '';
}


list($idh, $idp, $ids) = explode('.', $idToken);
$idPayload = json_decode(base64url_decode($idp), true);

list($ach, $acp, $acs) = explode('.', $accessToken);
$acPayload = json_decode(base64url_decode($acp), true);


$expiresAt = $acPayload['exp'] ?? (time() + 300);


$userInfo = $oidc->requestUserInfo();

$_SESSION['id_token']     = $idToken;
$_SESSION['access_token'] = $accessToken;
$_SESSION['refresh_token'] = $refreshToken;
$_SESSION['expires_at']    = $expiresAt;

$_SESSION['user'] = [
    'sub'      => $userInfo->sub ?? null,
    'username' => $userInfo->preferred_username ?? null,
    'email'    => $userInfo->email ?? null,
    'name'     => $userInfo->name ?? null,
];


$_SESSION['id_token_claims']   = $idPayload;
$_SESSION['access_token_claims'] = $acPayload;
$_SESSION['realm_roles']       = $acPayload['realm_access']['roles'] ?? [];
$_SESSION['resource_access']   = $acPayload['resource_access']['php-app'] ?? [];

header('Location: /');
exit;
