<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    public function getUserBy($field, $value){
        $result = $this->db->row("SELECT * FROM users WHERE $field='$value'");
        return $result;
    }
    ///////////
    public function checkLogin($login){
         if ($this->db->row("SELECT login FROM users WHERE login='$login'"))
             return false;
         else
             return true;
    }

    public function checkEmail($email){
        if ($this->db->row("SELECT email FROM users WHERE email='$email'"))
            return false;
        else
            return true;
    }

    public function checkToken($token, $table){
        $userByToken = $this->db->row("SELECT * FROM $table WHERE token='$token'");
        if ($userByToken)
            return $userByToken;
        else
            return false;
    }

    public function insertInto($table, $login, $email, $token){
        $this->db->insertto("INSERT INTO $table (login, email, token) VALUE ('$login', '$email', '$token')");
    }
////////////
    public function getEmail($login){
        return $this->db->row("SELECT email FROM users WHERE login='$login'");
    }

    public function getLogin($email){
        return $this->db->row("SELECT login FROM users WHERE email='$email'");
    }
////////
    public function addUserToSign($login, $pass, $email, $token, $table){
        if (!$this->checkLogin($login)){
            debug("user with the same name alredy exist");
            return false;
        }
        elseif (!$this->checkEmail($email)){
            debug("email is alredy in use");
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
            debug("user with the same name alredy exist");
            return false;
        }
        elseif (!$this->checkEmail($email)){
            debug("email is alredy in use");
            return false;
        }
        //elseif query??
        else {
            $this->db->insertto("INSERT INTO $table (login, password, email, isAdmin) VALUE ('$login', '$pass', '$email', '$isAdmin')");
            return true;
        }
    }
////////////


    public function delFrom($table, $field, $value){
        if($this->db->query("DELETE FROM $table WHERE $field='$value'"))
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

    public function updateTable($table, $field, $value, $user){
        if($this->db->query("UPDATE $table SET $field='$value' WHERE login='$user'"))
            return true;
        else
            return false;
    }
}
