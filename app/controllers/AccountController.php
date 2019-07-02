<?php

namespace app\controllers;
use app\core\Controller;
use app\core\View;
use app\lib\Db;

class AccountController extends Controller{

    public function before(){
        $this->view->layout = 'custom';

    }

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
        if(mail($email_to, $email_subject, $email_message, $header))
            return true;
        else
            return false;
    }

    public function signupAction() {
        if(!empty($_POST)){
            if($_GET['action'] == 'signup'){
                $login = $_POST['name'];
                $pass = hash('whirlpool', $_POST['passwd']);
                $email = $_POST['email'];
                $token = hash('whirlpool', $this->random_str(32));
                if ($this->model->addUser($login, $pass, $email, $token, "users")){
                    $name_from = 'kkostrub';
                    $email_from = 'kkostrub@student.unit.ua';
                    $email_to = $email;
                    $email_subject = 'Registration at website Camagru!';
                    $hostname = 'localhost';
                    $port = '8080';
                    $email_message = 'Hello '.$login.'. Please follow this link to confirm your email address and finish creating your Camagru account: http://'
                        . $hostname.':'.$port.'/camagru_mvc/account/confirm?token='.$token;
                    if($this->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message))
                        debug("email successfully sent");
                    else
                        debug("Send error, please try again");
                };
                header("location: signup");
            } elseif ($_GET['action'] == 'login'){
                $name = $_POST['name'];
                $pass = hash('whirlpool', $_POST['passwd']);
                $confirm = $this->model->checkConfirm($name);
                if ($this->model->checkValue($name, 'users', 'login') || $confirm[0]['isConfirm'] == 0)
                    debug("user not found");
                elseif($this->model->findUser($name, $pass)){
                    $_SESSION['authorize']['name'] = $name;
                    $cookie_name = "login";
                    $cookie_value = $name;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                    header('Location: /camagru_mvc/default/index');
                } else
                    debug("invalid password");
            }
        }
        $this->view->render('SIGNUP PAGE');
    }

    public function logoutAction(){
        session_start();
        foreach ($_SESSION as $key => $value){
            $_SESSION[$key] = FALSE;
        }
        header('Location: /camagru_mvc/account/signup');
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
            if(!$sqlLogin && !$sqlEmail)
                debug("user not found");
            $sql = ($sqlLogin) ? $sqlLogin : $sqlEmail;
            $email_to = $sql[0]['email'];
            $email_message = 'Hello '.$sql[0]['login'].'. Please follow this link to create new password. If it is not you, ignore this email: http://'
                    . $hostname.':'.$port.'/camagru_mvc/account/confirmpass?token='.$token;
            $this->model->updateTable('users', 'token', $token, 'login', $sql[0]['login']);
            if ($this->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message))
                debug("email successfully sent");
            else
                debug("Send error, please try again");
        }
        $this->view->render('CHANGEPASS PAGE');
    }

    public function confirmpassAction(){
        $url = $_SERVER['REQUEST_URI'];
        $arr_url = explode('=', $url);
        if (count($arr_url) == 2) {
            $token = $arr_url[1];
            $userInfo = $this->model->checkToken($token, 'users');
            //TODO: винести в окрему функцію
            date_default_timezone_set('Europe/Kiev');
            $getDate = $userInfo[0]['registrDate'];//$this->model->getDate($token);
            $timeForConfirm = 86400; //24h
            $currentDate = time();
            $passedTime = $currentDate - strtotime($getDate);
            if($userInfo && $passedTime <= $timeForConfirm)
                header('Location: /camagru_mvc/account/newpass?token=' . $userInfo[0]['token']);
            else
                debug("Sorry, a link not valid. Send link again");//View::errorCode(404);
        } else
            View::errorCode(404);
    }

    public function newpassAction(){
        if(!empty($_POST)){
            $passFirst = hash('whirlpool', $_POST['pass_first']);
            $passSecond = hash('whirlpool', $_POST['pass_second']);
            if($passFirst == $passSecond){
                $this->model->updateTable('users', 'password', $passFirst, 'token', $_GET['token']);
                //TODO:modal pass successfully changed
                header('Location: /camagru_mvc/account/signup');
            } else
                View::errorCode(404);
        }
        $this->view->render('NEWPASS PAGE');
    }

    public function confirmAction(){
        $url = $_SERVER['REQUEST_URI'];
        $arr_url = explode('token=', $url);
        if (count($arr_url) == 2){
            $token = $arr_url[1];
            $userInfo = $this->model->checkToken($token, 'users');
            if ($userInfo){
                //TODO: винести в окрему функцію
                date_default_timezone_set('Europe/Kiev');
                $getDate = $userInfo[0]['registrDate'];//$this->model->getDate($token);
                $timeForConfirm = 86400; //24h
                $currentDate = time();
                $passedTime = $currentDate - strtotime($getDate);
                //
                if($passedTime >= $timeForConfirm)
                    debug("Sorry, a link not valid. Please, Send link again");
                $isConfirm = $this->model->isConfirm($token);
                if($isConfirm[0]['isConfirm'] == 0) {
                    $this->model->setConfirm($token);
                    $this->model->updateDate($_GET['token']);
                    $_SESSION['authorize']['name'] = $userInfo[0]["login"];
                    $cookie_name = $userInfo[0]["login"];
                    $cookie_value = "login";
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                } else
                    debug("isConfirm");//View::errorCode(404);
                $this->view->render('CONFIRM PAGE');
            } else
                View::errorCode(404);
        }
        else
            View::errorCode(404);
    }


}




























