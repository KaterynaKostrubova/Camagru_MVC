<?php

namespace app\controllers;
use app\core\Controller;

class AccountController extends Controller{

//    public function before(){
//        $this->view->layout = 'custom';
//    }


    public function loginAction() {
        if(!empty($_POST)){
            $this->view->message('success', 'text');
//            $this->view->location('/mvc_php');
        }
//        $this->view->redirect('/mvc_php');
        $this->view->render('ACCOUNT PAGE');
    }

    public function signupAction(){
//        $this->view->path = 'test/test';
//        $this->view->layout = 'custom';

        $this->view->render('Sign UP ACCOUNT PAGE');
    }
}