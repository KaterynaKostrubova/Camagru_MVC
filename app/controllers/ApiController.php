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
