<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class PhotoController extends Controller
{


    public function takeAction(){
        $this->view->render('PHOTO PAGE');
    }


}