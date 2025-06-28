<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once 'vendor/autoload.php';
require_once __DIR__ . './env.php';
loadEnv();

function getToken($name, $id) {
    $secretKey = getenv('JWT_SECRET');
    $expire = getenv('JWT_EXPIRE');

    if (!$secretKey) {
        throw new Exception("JWT_SECRET não definido");
    }

    $payload =[
        'iss' => 'localhost',
        'aud' => 'localhost',
        'iat' => time(),
        'exp' => time() + $expire,
        'id' => $id,
        'name' => $name,
    ];

    $jwt = JWT::encode($payload, $secretKey, 'HS256');

    return $jwt;
}

function decodeToken($token) {
    $secretKey = getenv('JWT_SECRET');

    if (!$secretKey) {
        throw new Exception("JWT_SECRET não definido");
    }

    try {
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));

        return json_decode(json_encode($decoded), true);
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}
?>