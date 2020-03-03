<?php
namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\lib\Db;
use app\models\Photo;

class GalleryController extends Controller
{


    public  function galleryAction(){
        $photos = $this->model->getAllPhotos();
        $ownersAvatars = $this->model->getAllAvatars();

//        var_dump($photos);
//        echo '--------';
//        var_dump($ownersAvatars);
//        $vars = array();
//        while($row = mysqli_fetch_assoc($photos)){
//            $vars[] = $row;
        $model = new Photo();
        $usr = $model->getUserData($_SESSION['authorize']['name']);
        $avatar = $model->getNameImage($usr[0]['photo_id']);



        $vars = [
            'photos' => $photos,
            'info' => $usr,
            'avatar' => $avatar[0]['path'],
            'owners' => $ownersAvatars
        ];
//        var_dump($vars);

        $this->view->render('Gallery PAGE', $vars);
    }
}

//public function updateTable($table, $field, $value, $whereField, $whereValue){
//    if($this->db->query("UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'"))
//        return true;
//    else
//        return false;
//}