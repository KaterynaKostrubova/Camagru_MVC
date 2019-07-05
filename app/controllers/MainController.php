<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

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


        $result = $this->model->getUsers();
        $vars = [
            'users' => $result
        ];
//        debug($result);, $vars
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