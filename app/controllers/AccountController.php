<?php

namespace app\controllers;
use app\core\Controller;
use app\lib\Db;

class AccountController extends Controller{

//    public function before(){
//        $this->view->layout = 'custom';

//    }
    private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    private function sendEmail($email){
        $encoding = "utf-8";
        // Set preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        // Set mail header
        $header = "Content-type: text/html; charset=" . $encoding . " \r\n";
        $header .= "From: " . 'Camagru' . " <" . 'Camagru' . "> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: " . date("r (T)") . " \r\n";
        $header .= iconv_mime_encode("Subject", 'test', $subject_preferences);
        // Send mail
        mail($email, 'test', 'Hello', $header);
    }



    public function loginAction() {
        if(!empty($_POST)){
//            $this->view->message('success', 'text');
//            $this->view->location('/mvc_php');

//        $this->view->redirect('/mvc_php');
//        $db = new Db();
//        $form = '2; DELETE FROM users';
//        $params = [
//            'id' => 1,
//        ];

            $login = $_POST['name'];
            $pass = hash('whirlpool', $_POST['passwd']);
            $email = $_POST['email'];
            $token = hash('whirlpool', $this->random_str(32));
            if ($this->model->addUser($login, $pass, $email, $token)){
                $this->sendEmail($email);
            };
//            echo $login;
            header("location: login");
        }
        $this->view->render('ACCOUNT PAGE');
    }




}