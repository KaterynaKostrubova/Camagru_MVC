<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

//    public function addUser(){
//        print_r("jjkkjkjkjjkjkjkjkj");
////        return $this->db->insert("INSERT INTO user_register (login, password, email, token) VALUE ('$login', '$pass', '$email', '$token')");
////        $login, $pass, $email, $token
//    }

    public function getUsers(){
        $result = $this->db->row('SELECT login, email FROM user_register');
        return $result;
    }

}



