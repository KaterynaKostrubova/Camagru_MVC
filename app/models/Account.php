<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    public function getUserByToken($token){
        $result = $this->db->row("SELECT * FROM user_signup WHERE token='$token'");
        return $result;
    }

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

    public function addUserToSign($login, $pass, $email, $token, $table){
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
            $this->db->insertto("INSERT INTO $table (login, password, email, token) VALUE ('$login', '$pass', '$email', '$token')");
            return true;
        }
    }

    public function addUserToUsers($login, $pass, $email, $isAdmin, $table){
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
            $this->db->insertto("INSERT INTO $table (login, password, email, isAdmin) VALUE ('$login', '$pass', '$email', '$isAdmin')");
            return true;
        }
    }

    public function checkToken($token){
        $userByToken = $this->db->row("SELECT login, email, password, token FROM user_signup WHERE token='$token'");
        if ($userByToken)
            return $userByToken;
        else
            return false;
    }

    public function delUserFromSign($token){
        if($this->db->query("DELETE FROM user_signup WHERE token='$token'"))
            return true;
        else
            return false;
    }


    public function findUser($name, $pass){
        $sql = $this->db->row("SELECT password FROM users WHERE login='$name'");
//        debug($sql);
        if($sql[0]['password'] == $pass){
//            debug($sql);
            return true;
        } else
            return false;

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
