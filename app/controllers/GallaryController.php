<?php
namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\lib\Db;

class GalleryController extends Controller
{


    public  function gallaryAction(){



        $this->view->render('Gallary PAGE', $vars);

    }
}

//public function updateTable($table, $field, $value, $whereField, $whereValue){
//    if($this->db->query("UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'"))
//        return true;
//    else
//        return false;
//}