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

    public function sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message){
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
                $login = $pass = $email = $sex = "";
                $login = $this->test_input($_POST['name']);
                $pass = hash('whirlpool', $this->test_input($_POST['passwd']));
                $email = $this->test_input($_POST['email']);
                $token = hash('whirlpool', $this->random_str(32));
                $sex = $_POST['sex'];
                $photo = 1;
                if($sex === 'female')
                    $photo = 2;
//                var_dump($_POST);
//                echo $photo;
                if ($this->model->addUser($login, $sex, $photo, $pass, $email, $token, "users")){
                    $name_from = 'kkostrub';
                    $email_from = 'kkostrub@student.unit.ua';//$email_from = 'katerinakostrubova@gmail.com';
                    $email_to = $email;
                    $email_subject = 'Registration at website Camagru!';
                    $hostname = 'localhost';
                    $port = '8081';
                    $email_message = 'Hello '.$login.'. Please follow this link to confirm your email address and finish creating your Camagru account: http://'
                        . $hostname . ':' . $port . DIR_NAME . '/account/confirm?token='.$token;
                    if($this->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message))
                        debug("email successfully sent");
                    else
                        debug("Send error, please try again");
                };
                header("location: signup");
            } elseif ($_GET['action'] == 'login'){
                $name = $this->test_input($_POST['name']);
                $pass = hash('whirlpool', $this->test_input($_POST['passwd']));
                $confirm = $this->model->checkConfirm($name);
                if ($this->model->checkValue($name, 'users', 'login') || $confirm[0]['isConfirm'] == 0)
                    debug("user not found");
                elseif($this->model->findUser($name, $pass)){
                    $_SESSION['authorize']['name'] = $name;
                    $cookie_name = "login";
                    $cookie_value = $name;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                    header('Location: ' . DIR_NAME .'/default/index');
                } else
                    debug("invalid password");
            }
        }
//        $photos = $this->model->getPhoto();
//        $vars = [
//            'photo' => $photos
//        ];
        $this->view->render('SIGNUP PAGE');
    }

    public function logoutAction(){
        session_start();
        foreach ($_SESSION as $key => $value){
            $_SESSION[$key] = FALSE;
        }
        header('Location: ' . DIR_NAME . '/account/signup');
    }

    public function changepassAction() {
        if (!empty($_POST)){
            $login = $this->test_input($_POST['name']);
            $token = hash('whirlpool', $this->random_str(32));
            $name_from = 'kkostrub';
            $email_from = 'kkostrub@student.unit.ua';
//            $email_from = 'katerinakostrubova@gmail.com';
            $email_subject = 'Change password at website Camagru!';
            $hostname = 'localhost';
            $port = '8081';
            $sqlLogin = $this->model->getUserBy('login', $login);
            $sqlEmail = $this->model->getUserBy('email', $login);
            if(!$sqlLogin && !$sqlEmail)
                debug("user not found");
            $sql = ($sqlLogin) ? $sqlLogin : $sqlEmail;
            $email_to = $sql[0]['email'];
            $email_message = 'Hello '.$sql[0]['login'].'. Please follow this link to create new password. If it is not you, ignore this email: http://'
                    . $hostname.':'.$port. DIR_NAME .'/account/confirmpass?token='.$token;
            $this->model->updateTable('users', 'token', $token, 'login', $sql[0]['login']);
            if ($this->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message)){
                $this->model->updateDate($token, 'sendLinkDate');
                debug("email successfully sent");
            } else
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
            $getDate = $userInfo[0]['sendLinkDate'];
            $timeForConfirm = 86400; //24h
            $currentDate = time();
            $passedTime = $currentDate - strtotime($getDate);
            if($userInfo && $passedTime <= $timeForConfirm)
                header('Location: ' . DIR_NAME .'/account/newpass?token=' . $userInfo[0]['token']);
            else
                debug("Sorry, a link not valid. Send link again");//View::errorCode(404);
        } else
            View::errorCode(404);
    }

    public function newpassAction(){
        if(!empty($_POST)){
            $passFirst = hash('whirlpool', $this->test_input($_POST['pass_first']));
            $passSecond = hash('whirlpool', $this->test_input($_POST['pass_second']));
            if($passFirst == $passSecond){
                $this->model->updateTable('users', 'password', $passFirst, 'token', $this->test_input($_GET['token']));
                //TODO:modal pass successfully changed
                header('Location: ' . DIR_NAME .'/account/signup');
            } else
                debug("pass1 != pass2");
//                View::errorCode(404);

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
                    $this->model->updateDate($this->test_input($_GET['token']), 'registrDate');
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




























