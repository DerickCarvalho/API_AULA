<?php
require_once __DIR__ . '../../services/userService.php';
require_once __DIR__ . '../../helpers/jwt.php';

function createUser() {
    $infos = json_decode(file_get_contents("php://input"), true);

    $userExist = UserService::verifyUserExist($infos['login'], $infos['email']);

    if ($userExist['status'] === true) {
        $response = [
            "msg" => "Já existe um usuário com o Login ou Email informado!",
            "status" => "ERROR"
        ];
        http_response_code(409);
        echo json_encode($response);
        
        return;
    }

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

function logUser() {
    $infos = json_decode(file_get_contents("php://input"), true);

    $login = $infos['login'] ?? '';
    $email = $infos['email'] ?? '';

    $user = UserService::verifyUserExist($login, $email);

    if ($user['status'] === true) {
        $passwordIsValid = verifyPassword($infos['password'], $user['content']['senha']);

        if ($passwordIsValid === true) {
            $token = getToken($user['content']['nome'], $user['content']['id']);

            $response = [
                "msg" => "Usuário logado com sucesso!",
                "token" => $token,
                "status" => "OK"
            ];
            http_response_code(200);
            echo json_encode($response);
        }
        else {
            $response = [
                "msg" => "Senha incorreta!",
                "status" => "ERROR"
            ];
            http_response_code(401);
            echo json_encode($response);
        }
    }
    else {
        $response = [
            "msg" => "Usuário não encontrado!",
            "status" => "ERROR"
        ];
        http_response_code(404);
        echo json_encode($response);
    }
}

function verifyPassword($passwordFromReq, $passwordFromDb) {
    if ($passwordFromDb === $passwordFromReq) {
        return true;
    }
    else {
        return false;
    }
}
?>