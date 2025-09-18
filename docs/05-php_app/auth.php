<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config.php';
$issuer = rtrim($config['KEYCLOAK_BASE_URL'], '/') . '/realms/' . $config['REALM'];


function getAccessToken()
{
    if (!isset($_SESSION['access_token'])) {
        return null;
    }


    if (time() >= $_SESSION['expires_at']) {

        if (!refreshToken()) {

            header("Location: logout.php");
            exit;
        }
    }

    return $_SESSION['access_token'];
}

function refreshToken()
{
    global $config, $issuer;
    $tokenUrl = $issuer . '/protocol/openid-connect/token';

    $data = [
        'grant_type'    => 'refresh_token',
        'refresh_token' => $_SESSION['refresh_token'],
        'client_id'     => $config['CLIENT_ID'],
        'client_secret' => $config['CLIENT_SECRET']
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ]
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($tokenUrl, false, $context);

    if ($result === FALSE) {
        return false;
    }

    $token = json_decode($result, true);

    if (isset($token['access_token'])) {
        $_SESSION['access_token'] = $token['access_token'];
        $_SESSION['id_token'] = $token['id_token'];
        $_SESSION['refresh_token'] = $token['refresh_token'];
        $_SESSION['expires_at'] = time() + $token['expires_in'];


        list(, $idp,) = explode('.', $_SESSION['id_token']);
        $_SESSION['id_token_claims'] = json_decode(base64_decode(strtr($idp, '-_', '+/')), true);


        list(, $acp,) = explode('.', $_SESSION['access_token']);
        $_SESSION['access_token_claims'] = json_decode(base64_decode(strtr($acp, '-_', '+/')), true);


        $_SESSION['realm_roles']    = $_SESSION['access_token_claims']['realm_access']['roles'] ?? [];
        $_SESSION['resource_access'] = $_SESSION['access_token_claims']['resource_access']['php-app'] ?? [];
        return true;
    }

    return false;
}

function requireLogin()
{
    if (!isset($_SESSION['access_token'])) {
        header("Location: login.php");
        exit;
    }
}
