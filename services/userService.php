<?php
require_once __DIR__ . '../../models/user.php';

class UserService {
    public static function registUser($infos) {
        if(
            empty($infos['name']) ||
            empty($infos['birth_date']) ||
            empty($infos['login']) ||
            empty($infos['email']) ||
            empty($infos['password'])
        ) {
            return [
                "status" => false,
                "msg" => "Preencha todos os campos!"
            ];
        }

        return User::create($infos);
    }
}
?>