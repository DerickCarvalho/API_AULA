<?php

function loadEnv($path = __DIR__ . '../../.env') {
    if (!file_exists($path)) {
        throw new Exception("Erro ao puxar arquivo .env");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strrpos(trim($line), '#') === 0) {
            continue;
        }

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}

?>