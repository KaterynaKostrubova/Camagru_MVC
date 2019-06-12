<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    private function checkLogin($login){
         if ($this->db->row("SELECT login FROM users WHERE login='$login'"))
             return false;
         else
             return true;
    }

    private function checkEmail($email){
        if ($this->db->row("SELECT email FROM users WHERE email='$email'"))
            return false;
        else
            return true;
    }

    public function addUser($login, $pass, $email, $token){
        if (!$this->checkLogin($login)){
//           modal window debug("user with the same name alredy exist");
            return false;
        }
        elseif (!$this->checkEmail($email)){
//            modal window debug("email is alredy in use");
            return false;
        }
        //elseif query??
        else {
            $this->db->insertto("INSERT INTO users (login, password, email, token) VALUE ('$login', '$pass', '$email', '$token')");
            return true;
        }
    }

    public function checkToken($token){
//        var_dump($this->db->row("SELECT login, token FROM users WHERE token='$token'"));
        if (!$this->db->row("SELECT login, token FROM users WHERE token='$token'"))
            return false;
        else
            return true;
    }
}
