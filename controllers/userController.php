<?php
require_once __DIR__ . '../../services/userService.php';

function createUser() {
    $infos = json_decode(file_get_contents("php://input"), true);

    $result = UserService::registUser($infos);

    if ($result['status'] === true) {
        $response = [
            "msg" => "Usuário cadastrado com sucesso!",
            "status" => "OK"
        ];
        http_response_code(201);
        echo json_encode($response);
    }
    else {
        $response = [
            "msg" => "Erro ao cadastrar usuário!",
            "status" => "ERROR"
        ];
        http_response_code(500);
        echo json_encode($response);
    }
}
?>