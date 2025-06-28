<?php
require_once __DIR__ . '../../controllers/userController.php';

if ($request === '/cadastrarUsuario' && $method === 'POST') {
    createUser();
}
else if ($request === '/logarUsuario' && $method === 'POST') {
    logUser();
}
else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não reconhecida pelo servidor!']);
}
?>