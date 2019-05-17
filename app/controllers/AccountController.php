<?php

namespace app\controllers;
use app\core\Controller;

class AccountController extends Controller{

//    public function before(){
//        $this->view->layout = 'custom';
//    }


    public function loginAction() {
        $this->view->redirect('/mvc_php');
        $this->view->render('ACCOUNT PAGE');
    }

    public function signupAction(){
//        $this->view->path = 'test/test';
//        $this->view->layout = 'custom';

        $this->view->render('Sign UP ACCOUNT PAGE');
    }
}