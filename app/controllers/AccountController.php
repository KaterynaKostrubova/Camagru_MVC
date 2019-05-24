<?php

namespace app\controllers;
use app\core\Controller;
use app\lib\Db;

class AccountController extends Controller{

//    public function before(){
//        $this->view->layout = 'custom';
//    }


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
            $token = hash('whirlpool', 2333434);
            $this->model->addUser($login, $pass, $email, $token);
            echo $login;
            header("location: login");
        }
//        echo 2;
        $this->view->render('ACCOUNT PAGE');
    }


}