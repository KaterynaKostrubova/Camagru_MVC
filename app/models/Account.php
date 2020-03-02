<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    public function getUserBy($field, $value){
        $result = $this->db->row("SELECT * FROM users WHERE $field='$value'");
        return $result;
    }
    ///////////
    public function checkValue($login, $table, $value){
         if ($this->db->row("SELECT $value FROM $table WHERE $value='$login'"))
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

    public function checkConfirm($name){
        return $this->db->row("SELECT isConfirm FROM users WHERE login='$name'");
    }

    public function insertInto($table, $login, $email, $token){
        $this->db->insertto("INSERT INTO $table (login, email, token) VALUE ('$login', '$email', '$token')");
    }
////////////
    public function getValue($login){
        return $this->db->row("SELECT email FROM users WHERE login='$login'");
    }

    public function getLogin($email){
        return $this->db->row("SELECT login FROM users WHERE email='$email'");
    }

    public function getDate($token){
        return $this->db->row("SELECT registrDate FROM users WHERE token='$token'");
    }


////////
    public function addUser($login, $sex, $photo_id, $pass, $email, $token, $table){
        if (!$this->checkValue($login, $table, 'login')){
            debug("user with the same name alredy exist");
            return false;
        }
        elseif (!$this->checkValue($email, $table, 'email')){
            debug("email is alredy in use");
            return false;
        }
        //elseif query??
        else {
            $this->db->insertto("INSERT INTO $table (login, sex, photo_id, email, password, token) VALUE ('$login', '$sex', '$photo_id','$email', '$pass', '$token')");
            return true;
        }
    }

    public function setConfirm($token){
        if($this->db->query("UPDATE users SET isConfirm=true WHERE token='$token'"))
            return true;
        else
            return false;
    }
    public function isConfirm($token){
        $sql = $this->db->row("SELECT isConfirm FROM users WHERE token='$token'");
        return $sql;
    }

////////////

    public function findUser($name, $pass){
        $sql = $this->db->row("SELECT password FROM users WHERE login='$name'");
        if($sql[0]['password'] == $pass){
            return true;
        } else
            return false;

    }

    public function updateTable($table, $field, $value, $whereField, $whereValue){
        if($this->db->query("UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'"))
            return true;
        else
            return false;
    }

    public function updateDate($token, $field){
        if($this->db->query("UPDATE users SET $field=CURRENT_TIMESTAMP WHERE token='$token'"))
            return true;
        else
            return false;
    }

    public function getUser($user){
        $result = $this->db->row("SELECT * FROM users WHERE login='$user'");
        return $result;
    }

//    public function getPhoto(){
//        return  $this->db->row("SELECT path FROM photos LIMIT 3");
//
//    }




}
