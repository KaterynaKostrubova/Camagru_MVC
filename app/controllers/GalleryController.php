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
        $avatar = $model->getNameImage($usr[0]['photo_id']);
        $photos = $this->model->getAllPhotos($usr[0]['id']);
        $ownersAvatars = $this->model->getAllAvatars();

//        $likes = $model->getLikes($usr[0]['id']);
//        $comments = $model->getComments();
//        var_dump($likes);
//
//        var_dump($comments);
        $vars = [
            'photos' => $photos,
            'info' => $usr,
            'avatar' => $avatar[0]['path'],
            'owners' => $ownersAvatars,
//            'likes' => $likes,
//            'comments' => $comments
        ];
//        var_dump($vars);
        $this->view->render('Gallery PAGE', $vars);
    }

    public  function photoAction(){
        $model = new Photo();
        $usr = $model->getUserData($_SESSION['authorize']['name']);
        $avatar = $model->getNameImage($usr[0]['photo_id']);
//        ----------------
        $id = $_GET['id'];
        $pictureData = $model->getPictureData($id);
        $owner = $model->getOwnerInfo($pictureData[0]['user_id']);
        $avaId = $owner[0]['photo_id'];
        $loginOwner = $owner[0]['login'];
        $avaPath = $model->getPictureData($avaId)[0]['path'];
        $like = $model->isMyLike($id, $usr[0]['id']);
        $comments = $model->getComments($id);
        $numberLikes = count($model->getLikes($id));
//        var_dump($avaPath);
        $vars = [
            'info' => $usr,
            'id' => $id,
            'login' => $loginOwner,
            'avatar' => $avatar[0]['path'],
            'picturePath' => $pictureData[0]['path'],
            'avaPath'=>$avaPath,
            'like' => $like,
            'comments' => $comments,
            'numberOfLikes' => $numberLikes,
        ];

        $this->view->render('Gallery PAGE', $vars);
    }
}

//public function updateTable($table, $field, $value, $whereField, $whereValue){
//    if($this->db->query("UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'"))
//        return true;
//    else
//        return false;
//}