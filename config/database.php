<?php
function conn() {
    $host = "localhost";
    $dbname = "banco_aula";
    $user = "root";
    $password = "Senha123#";

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
?>