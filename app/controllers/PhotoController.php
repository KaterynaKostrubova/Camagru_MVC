<?php
namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class PhotoController extends Controller
{
    public function takeAction(){
        $filters = $this->model->getFilters();
        $usr = $this->model->getUserData($_SESSION['authorize']['name']);
        $edited_photos = $this->model->getEditedPhotos($usr[0]['id']);
        $avatar = $this->model->getNameImage($usr[0]['photo_id']);
        $vars = [
            'filters' => $filters,
            'edited_photos' => $edited_photos,
            'info' => $usr,
            'avatar' => $avatar[0]['path']
        ];

        $this->view->render('PHOTO PAGE', $vars);
    }


}