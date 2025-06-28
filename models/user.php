<?php
require_once __DIR__ . '../../config/database.php';

class User {
    public static function create($infos) {
        $pdo = conn();

        $params = [
            ":name" => $infos['name'],
            ":birth_date" => $infos['birth_date'],
            ":login" => $infos['login'],
            ":email" => $infos['email'],
            ":password" => $infos['password']
        ];

        $query = "INSERT INTO usuarios (nome, dta_nascimento, login, email, senha)
        VALUES (:name, :birth_date, :login, :email, :password)";

        $stmt = $pdo->prepare($query);
        $success = $stmt->execute($params);
        
        if ($success) {
            $response = [
                "status" => true
            ];
            return $response;
        }
        else {
            $response = [
                "status" => false
            ];
            return $response;
        }
    }

    public static function findUserByLoginOrEmail($login, $email) {
        $pdo = conn();

        $params = [
            ":login" => $login,
            ":email" => $email
        ];

        $query = "SELECT * FROM usuarios WHERE login = :login OR email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $content = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($content) {
            $response = [
                "status" => true,
                "content" => $content
            ];
            return $response;
        }
        else {
            $response = [
                "status" => false
            ];
            return $response;
        }
    }
}
?>