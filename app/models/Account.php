<?php

namespace app\models;

use app\core\Model;

class Account extends Model {

    private function checkLogin($login){
        $allUsers = $this->db->row("SELECT login FROM users");
        foreach ($allUsers as $item){
            if ($login == $item["login"])
                return false;
        }
        return true;
    }

    private function checkEmail($email){
        $allUsers = $this->db->row("SELECT email FROM users");
        foreach ($allUsers as $item){
            if ($email == $item["email"])
                return false;
        }
        return true;
    }

    public function addUser($login, $pass, $email, $token){
        if (!$this->checkLogin($login)){
//            debug("user with the same name alredy exist");
            return false;
        }
        elseif (!$this->checkEmail($email)){
//            debug("email is alredy in use");
            return false;
        }
        else {
            $this->db->insertto("INSERT INTO users (login, password, email, token) VALUE ('$login', '$pass', '$email', '$token')");
            return true;
        }


//        $encoding = "utf-8";
//    // Set preferences for Subject field
//        $subject_preferences = array(
//            "input-charset" => $encoding,
//            "output-charset" => $encoding,
//            "line-length" => 76,
//            "line-break-chars" => "\r\n"
//        );
//    // Set mail header
//        $header = "Content-type: text/html; charset=" . $encoding . " \r\n";
//        $header .= "From: " . 'Camagru' . " <" . 'Camagru' . "> \r\n";
//        $header .= "MIME-Version: 1.0 \r\n";
//        $header .= "Content-Transfer-Encoding: 8bit \r\n";
//        $header .= "Date: " . date("r (T)") . " \r\n";
//        $header .= iconv_mime_encode("Subject", 'test', $subject_preferences);
//    // Send mail
//        mail($email, 'test', 'Hello', $header);
    }
}
