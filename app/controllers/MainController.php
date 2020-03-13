<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;
use app\models\Account;

class MainController extends Controller {

    //    public function before(){
//        $this->view->layout = 'custom';
//
//    }

    public function indexAction() {

        $model = new Account();
        $user = $model->getUser($_SESSION['authorize']['name']);
        $avatarPath = $this->model->getPath($user[0]['photo_id']);
        $bgPath = $this->model->getPath($user[0]['bg_id']);
        $photos = $this->model->getUserPhotos($user[0]['id']);

        $vars = [
            'info' => $user,
            'avatar'=> $avatarPath,
            'bg_photo'=> $bgPath,
            'photos' => $photos
        ];

        $this->view->render('MAIN PAGE', $vars);
    }

//    public  function profileAction(){
//        $userInfo = $this->model->getUser($_SESSION['authorize']['name']);
////        debug($name);
//        $vars = [
//            'info' => $userInfo
//        ];
//        $this->view->render('PROFILE PAGE', $vars);
//    }













}