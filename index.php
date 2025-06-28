<?php
require_once './helpers/env.php';
loadEnv();

// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    print_r("API Para estudos em PHP puro\n\nVersão: 1.0.0");
    http_response_code(200);
    exit;
}

// VARIAVEL GLOBAL PARA PEGAR A REQUEST E O METHOD
$request = '/' . ($_GET['route'] ?? '');
$method = $_SERVER['REQUEST_METHOD'];

// INCLUIR OS ARQUIVOS PRINCIPAIS
require_once 'config/database.php';
require_once 'routes/userRoutes.php';
?>