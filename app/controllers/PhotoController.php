<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class PhotoController extends Controller
{


    public function takeAction(){
        $filters = $this->model->getFilters();
        $vars = [
            'filters' => $filters
        ];

        $this->view->render('PHOTO PAGE', $vars);
    }


}