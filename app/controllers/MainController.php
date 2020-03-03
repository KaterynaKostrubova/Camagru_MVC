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
//        $vars = [
//            'name' => 'Kate',
//            'age'  => '26',
//            'arr'  => [1, 2, 3],
//        ];
//        $this->view->render('MAIN PAGE', $vars);
//        $db = new Db();

//        $form = '2; DELETE FROM users';
//        $params = [
//            'id' => 1,
//        ];
//
//        $data = $db->column('SELECT login FROM users WHERE id = :id', $params);
//        debug($data);


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
//        var_dump($vars);

        $this->view->render('MAIN PAGE', $vars);
//        debug($_SESSION);



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