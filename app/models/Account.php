<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    public function getUserByToken($token){
        $result = $this->db->row("SELECT * FROM user_signup WHERE token='$token'");
        return $result;
    }

    private function checkLogin($login){
         if ($this->db->row("SELECT login FROM user_signup WHERE login='$login'"))
             return false;
         else
             return true;
    }

    private function checkEmail($email){
        if ($this->db->row("SELECT email FROM user_signup WHERE email='$email'"))
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
            $this->db->insertto("INSERT INTO user_signup (login, password, email, token) VALUE ('$login', '$pass', '$email', '$token')");
            return true;
        }
    }

    public function checkToken($token){
//        var_dump($this->db->row("SELECT login, token FROM user_register WHERE token='$token'"));
        if (!$this->db->row("SELECT login, token FROM user_signup WHERE token='$token'"))
            return false;
        else
            return true;
    }

//    public function usersTable(){
//        $this->db->row("CREATE TABLE IF NOT EXISTS users (
//		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
//		login VARCHAR(254) NOT NULL,
//		password TEXT NOT NULL,
//		email VARCHAR(254),
//		token TEXT NOT NULL,
//		isAdmin BOOLEAN NOT NULL DEFAULT FALSE");
//    }
}
