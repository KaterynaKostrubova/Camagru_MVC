<?php
namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\lib\Db;
use app\models\Photo;

class GalleryController extends Controller
{


    public  function galleryAction(){
        $model = new Photo();
        $usr = $model->getUserData($_SESSION['authorize']['name']);

        if ($usr){
            $avatar = $model->getNameImage($usr[0]['photo_id'])[0]['path'];
        } else {
            $avatar = '/camagru_mvc/photos/male.svg';
        }
        $photos = $this->model->getAllPhotos();
        $ownersAvatars = $this->model->getAllAvatars();
        $vars = [
            'photos' => $photos,
            'info' => $usr,
            'avatar' => $avatar,
            'owners' => $ownersAvatars,
        ];
        $this->view->render('Gallery PAGE', $vars);
    }

    public  function photoAction(){
        $model = new Photo();
        $usr = $model->getUserData($_SESSION['authorize']['name']);
        $avatar = $model->getNameImage($usr[0]['photo_id']);
        $id = $_GET['id'];
        $pictureData = $model->getPictureData($id);
        if($pictureData){
            $owner = $model->getOwnerInfo($pictureData[0]['user_id']);
            $avaId = $owner[0]['photo_id'];
            $loginOwner = $owner[0]['login'];
            $avaPath = $model->getPictureData($avaId)[0]['path'];
            $like = $model->isMyLike($id, $usr[0]['id']);
            $comments = $model->getComments($id);
            $numberLikes = count($model->getLikes($id));

            $vars = [
                'info' => $usr,
                'id' => $id,
                'login' => $loginOwner,
                'avatar' => $avatar[0]['path'],
                'userId' => $pictureData[0]['user_id'],
                'picturePath' => $pictureData[0]['path'],
                'avaPath'=>$avaPath,
                'like' => $like,
                'comments' => $comments,
                'numberOfLikes' => $numberLikes,
            ];

            $this->view->render('Gallery PAGE', $vars);
        } else {

            $vars = [
                'info' => $usr,
                'id' => $id,
                'avatar' => $avatar[0]['path'],
                'picturePath' => '',
            ];

            $this->view->render('Gallery PAGE', $vars);
        }


    }
}