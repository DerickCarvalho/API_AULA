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

        try {
            $stmt->execute($params);

            return [
                "status" => true
            ];
        }
        catch (\Throwable $th) {
            $response = [
                "status" => false,
                "error" => $th
            ];
            return $response;
        }
    }
}
?>