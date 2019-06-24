<?php

namespace app\controllers;
use app\core\Controller;
use app\core\View;
use app\lib\Db;

class AccountController extends Controller{

//    public function before(){
//        $this->view->layout = 'custom';
//
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

    public function signupAction() {
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
            if ($this->model->addUserToSign($login, $pass, $email, $token, "user_signup")){
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
        $this->view->render('SIGNUP PAGE');
    }

    public function loginAction() {
        if(!empty($_POST)){
            $name = $_POST['name'];
            $pass = hash('whirlpool', $_POST['passwd']);
            if ($this->model->findUser($name, $pass)){
                $_SESSION['authorize']['name'] = $name;
                header('Location: /camagru_mvc/default/index');
            }
        }
        $this->view->render('LOGIN PAGE');
    }

    public function logoutAction(){
        session_start();
        foreach ($_SESSION as $key => $value) {
            $_SESSION[$key] = FALSE;
        }
        header('Location: /camagru_mvc/account/login');
    }

    public function changepassAction() {
        if (!empty($_POST)){
            $login = $_POST['name'];
            $token = hash('whirlpool', $this->random_str(32));
            $name_from = 'kkostrub';
            $email_from = 'kkostrub@student.unit.ua';
            $email_subject = 'Change password at website Camagru!';
            $hostname = 'localhost';
            $port = '8080';
            $sqlLogin = $this->model->getUserBy('login', $login);
            $sqlEmail = $this->model->getUserBy('email', $login);
            $sql = ($sqlLogin) ? $sqlLogin : $sqlEmail;
            $email_to = $sql[0]['email'];
            $email_message = 'Hello '.$sql[0]['login'].'. Please follow this link to create new password. If it is not you, ignore this email: http://'
                    . $hostname.':'.$port.'/camagru_mvc/account/confirmpass?token='.$token;
            $this->model->insertInto('change_password', $sql[0]['login'], $sql[0]['email'], $token);
            $this->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message);
        }
        $this->view->render('CHANGEPASS PAGE');
    }

    public function confirmpassAction(){
        $url = $_SERVER['REQUEST_URI'];
        $arr_url = explode('token=', $url);
        if (count($arr_url) == 2) {
            $token = $arr_url[1];
            $userInfo = $this->model->checkToken($token, 'change_password');
            if($userInfo){
//                $this->model->delFrom('change_password', 'token', $token);
                $this->view->render('CONFIRMPASS PAGE');
            } else
                View::errorCode(404);
        } else
            View::errorCode(404);
    }

    public function newpassAction(){
        if(!empty($_POST)){
            $passFirst = hash('whirlpool', $_POST['pass_first']);
            $passSecond = hash('whirlpool', $_POST['pass_second']);
            if($passFirst == $passSecond){
                $this->model->updateTable('users', 'password', $passFirst, );
                header('Location: /camagru_mvc/account/login');
            } else
                View::errorCode(404);
        }
        $this->view->render('NEWPASS PAGE');
    }

    public function confirmAction(){
        $url = $_SERVER['REQUEST_URI'];
        $arr_url = explode('=', $url);
        if (count($arr_url) == 2){
            $token = $arr_url[1];
            $userInfo = $this->model->checkToken($token, 'user_signup');
            if ($userInfo){
                if($this->model->addUserToUsers($userInfo[0]["login"], $userInfo[0]["password"], $userInfo[0]["email"], 0, "users")){
                    $this->model->delFrom('user_signup', 'token', $token);
                    $_SESSION['authorize']['name'] = $userInfo[0]["login"];
                }
                $this->view->render('CONFIRM PAGE');
            } else
                View::errorCode(404);
        }
        else
            View::errorCode(404);
    }


}




























