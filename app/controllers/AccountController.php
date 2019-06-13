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

    private function sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message){
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
        $header .= "From: " . $name_from . " <" . $email_from . "> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: " . date("r (T)") . " \r\n";
        $header .= iconv_mime_encode("Subject", $email_subject, $subject_preferences);
        // Send mail
        mail($email_to, $email_subject, $email_message, $header);
    }

    public function loginAction() {
        if(!empty($_POST)){
//            $this->view->message('success', 'text');
//            $this->view->location('/camagru_mvc');

//        $this->view->redirect('/camagru_mvc');
//        $db = new Db();
//        $form = '2; DELETE FROM user_register';
//        $params = [
//            'id' => 1,
//        ];

            $login = $_POST['name'];
            $pass = hash('whirlpool', $_POST['passwd']);
            $email = $_POST['email'];
            $token = hash('whirlpool', $this->random_str(32));
            if ($this->model->addUser($login, $pass, $email, $token)){
                $name_from = 'kkostrub';
                $email_from = 'kkostrub@student.unit.ua';
                $email_to = $email;
                $email_subject = 'Registration at website Camagru!';
                $hostname = 'localhost';
                $port = '8080';
                $email_message = 'Hello '.$login.'. Please follow this link to confirm your email address and finish creating your Camagru account: http://'
                    . $hostname.':'.$port.'/camagru_mvc/account/confirm?token='.$token;
                $this->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message);
            };
            header("location: login");
        }
        $this->view->render('ACCOUNT PAGE');
    }

    public function confirmAction(){
        $url = $_SERVER['REQUEST_URI'];
//        echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $arr_url = explode('=', $url);
        $token = $arr_url[1];
        if ($this->model->checkToken($token)){
//                    echo 'token: '.$token;
                    $newUser = $this->model->getUserByToken($token);
                    var_dump($newUser);

        }
        $this->view->render('CONFIRM PAGE');
    }
}




























