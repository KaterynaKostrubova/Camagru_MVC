<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class ProfileController extends Controller
{


    public  function profileAction(){

        $userInfo = $this->model->getUser($_SESSION['authorize']['name']);
        $vars = [
            'info' => $userInfo
        ];
        if($_POST['submit'] == 'save'){
//            debug($_POST);
//            $this->model->updateTable()
            $this->view->render('PROFILE PAGE', $vars);
        }

    }

    public  function editAction(){
        $userInfo = $this->model->getUser($_SESSION['authorize']['name']);
        $vars = [
            'info' => $userInfo
        ];
//        debug($_POST);
        if($_POST['submit'] == 'edit')
            $this->view->render('PROFILE PAGE', $vars);
}





}

//public function updateTable($table, $field, $value, $whereField, $whereValue){
//    if($this->db->query("UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'"))
//        return true;
//    else
//        return false;
//}