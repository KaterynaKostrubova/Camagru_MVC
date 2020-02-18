<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Account;
use app\models\Gallery;
use app\models\Profile;


class ApiController extends Controller
{

    public  function profileEditAction(){
        $currentLogin = $_SESSION['authorize']['name'];
        $newLogin = $this->request['name'];
        $newEmail = $this->test_input($this->request['email']);
        $newNotification = $this->request['notification'];

        // TODO update user`s data
        $model = new Account();
        $user = $model->getUser($currentLogin);

        $currentEmail = $user[0]['email'];

//        $changed_name = false;
//        $changed_email = false;

        $currentNotification = $user[0]['notification'];
//        $changedNotification = false;

        if ($currentLogin != $newLogin || $currentEmail != $newEmail || $currentNotification != $newNotification){
            if($model->checkValue($newLogin, 'users', 'login')) {
                $model->updateTable('users', 'login', $newLogin, 'login', $currentLogin);
                $_SESSION['authorize']['name'] = $newLogin;
                $cookie_name = $newLogin;
                $cookie_value = "login";
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                $currentLogin = $newLogin;
//                $changed_name = true;
            }
            if ($model->checkValue($newEmail, 'users', 'email')) {
                $model->updateTable('users', 'email', $newEmail, 'email', $currentEmail);
                $currentEmail = $newEmail;
//                $changed_email = true;
            }

            if ($this->request['notification'] === false){
                $model->updateTable('users', 'notification',  '0', 'login', $currentLogin);
                $currentNotification = $newNotification;
//                $changedNotification = true;
            }
            elseif ($this->request['notification'] === true) {
                $model->updateTable('users', 'notification',  '1', 'login', $currentLogin);
                $currentNotification = $newNotification;
//                $changedNotification = true;
            }

            $responseData = array(
                'status' => 'ok',
                'name' => '',
                'email' => '',
                'notification' => '',
                'data' => $currentLogin . ' | ' . $currentEmail . ' | ' . $currentNotification,
            );

//            if ($changed_name === true) {
//                $responseData['name'] = 'yes';
//            } else {
//                $responseData['name'] = 'no';
//            }
//            if ($changed_email === true) {
//                $responseData['email'] = 'yes';
//
//            } else {
//                $responseData['email'] = 'no';
//            }
//            if ($changedNotification === true){
//                $responseData['notification'] = 'yes';
//            } else {
//                $responseData['notification'] = 'no';
//            }
            $this->view->apiRender($responseData);
        }
    }

    public function savePhotoAction(){










//        $currentUser = $_SESSION['authorize']['name'];
        var_dump($_POST);

//        -----------------------
//        $image = imagecreate(200, 200);
//        $bgr = imagecolorallocate($image, 0, 0, 0);
//        $fbg = imagecolorallocate($image, 255, 255, 255);
//        $img_1 = imagecreatefrompng($_POST["data"]);
//        $img_2 = imagecreatefrompng($_POST["filter"]);
//
//        imagecolortransparent($img_2, $bgr);
//
//        imagecopy($img_1, $img_2, 10, 9, 0, 0, 1000, 1400);
//        header('Content-Type: image/png');
//        imagepng($img_1);
        $img = imagecreatefrompng($_POST["data"]);
        $png = imagecreatefrompng($_POST["filter"]);
        imagecolortransparent($png, imagecolorat($png, 0, 0));
        imagecopymerge($img, $png, 0, 0, 0, 0, 960, 720, 100);
        imagepng($img, "/camagru_mvc/photos/" . 7 .".png", 5);
//        ----------------------
//        $model = new Account();



//        $this->view->apiRender();
    }


//    public  function paginationAction(){
//        $model = new Gallery();
//        $photo = $model->getPartOfPhotos();
//        $test = array(
//            'data' => $photo
//        );
//        var_dump($photo);
//        $this->view->apiRender($test);
//    }


}
