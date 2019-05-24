<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    public function addUser($login, $pass, $email, $token){
//        print_r("jjkkjkjkjjkjkjkjkj");
        $this->db->insertto("INSERT INTO users (login, password, email, token) VALUE ('$login', '$pass', '$email', '$token')");
//
    }

}
