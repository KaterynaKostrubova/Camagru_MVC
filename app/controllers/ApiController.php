<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Account;
use app\models\Gallery;
use app\models\Photo;
use app\models\Profile;
use Exception;
use PDOException;

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
        $model = new Photo();
        $usr = $model->getUserData($_SESSION['authorize']['name']);

        $img = imagecreatefrompng($_POST["data"]);
        $png = imagecreatefrompng($_POST["filter"]);
        imagecolortransparent($png, imagecolorat($png, 0, 0));
        imagecopymerge($img, $png, 0, 0, 0, 0, 960, 720, 100);
        $rnd_file_name = uniqid() . ".png";
        $file_name = "photos/" . $rnd_file_name;
        imagepng($img, $file_name, 5);
        $path = '/camagru_mvc/' . $file_name;
        $model->addPhoto($path, $usr[0]['id'], $_SESSION['authorize']['name'], 'description');
        $id = $model->getIdPhoto($path);
        $responseData = array(
            'status' => 'ok',
            'id' => $id[0]['id'],
            'photo' => $path,
            'file_name' => $rnd_file_name,
        );

        $this->view->apiRender($responseData);
    }


    function delete_file($directory,$filename){
        // открываем директорию (получаем дескриптор директории)
        $dir = opendir($directory);

        // считываем содержание директории
        while(($file = readdir($dir))) {
            // Если это файл и он равен удаляемому ...
            if((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename")) {
                // ...удаляем его.
                unlink("$directory/$file");

                // Если файла нет по запрошенному пути, возвращаем TRUE - значит файл удалён.
                if(!file_exists($directory."/".$filename)) return TRUE;
            }
        }
        // Закрываем дескриптор директории.
        closedir($dir);
    }

    public function deletePhotoAction(){
        $model = new Photo();
        $test = $model->checkAvatar($this->request['id']);
        $path = '';
        if ($test){
            $acc = new Account();
            $login = $_SESSION['authorize']['name'];
            $usr = $acc->getUserBy('login', $login);
            $photo_id = 1;
            if($usr[0]['sex'] === 'female')
                $photo_id = 2;
            $model->changeAvatar($photo_id, $usr[0]['id']);
            $path = $model->getNameImage($photo_id)[0]['path'];
        }
        $file_name = $model->getNameImage($this->request['id']);
        $model->deleteLikes($this->request['id']);
        $model->deleteComments($this->request['id']);
        $model->delImage($this->request['id']);
        $name = explode('/', $file_name[0]['path']);
        $this->delete_file('photos/', $name[3]);
        $responseData = array(
            'status' => 'ok',
            'id' => $this->request['id'],
            '$file_name' => $name[3],
            'test' => $test,
            'path' => $path,
        );

        $this->view->apiRender($responseData);
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

    public function  changeAvatarAction(){
        $model = new Photo();
        if($this->request['id'] === '0'){
            $acc = new Account();
            $login = $_SESSION['authorize']['name'];
            $usr = $acc->getUserBy('login', $login);
            $photo_id = 1;
            if($usr[0]['sex'] === 'female')
                $photo_id = 2;
            $model->changeAvatar($photo_id, $usr[0]['id']);
            $path = $model->getNameImage($photo_id);
            $responseData = array(
                'status' => 'ok',
                'id' => $usr[0]['id'],
                'photo_id' => $photo_id,
                'path' => $path[0]['path'],
            );
        } else {
            $model->changeAvatar($this->request['photo_id'], $this->request['id']);
            $path = $model->getNameImage($this->request['photo_id']);
            $responseData = array(
                'status' => 'ok',
                'id' => $this->request['id'],
                'photo_id' => $this->request['photo_id'],
                'path' => $path[0]['path'],
            );
        }
        $this->view->apiRender($responseData);
    }

    public function  changeBgAction(){
        $model = new Photo();
        $model->changeBg($this->request['bg_id'], $this->request['id']);
        $path = $model->getNameImage($this->request['bg_id']);
        $responseData = array(
            'status' => 'ok',
            'id' => $this->request['id'],
            'bg_id' => $this->request['bg_id'],
            'path' => $path[0]['path'],
        );

        $this->view->apiRender($responseData);
    }

    public function  likeAction(){
            $model = new Photo();
            $userModel = new Profile();
            $login = $_SESSION['authorize']['name'];
            $user = $userModel->getUser($login);
            $responseData = array(
                'status' => 'error',
            );
            if ($user) {
                $photo_id = $this->request['id'];
                $usr_id = $user[0]['id'];
                $like = $this->request['like'];
                    if ($like) {
                        $model->removeLike($photo_id, $usr_id);
                    }
                    else {
                        $model->addLike($photo_id, $usr_id);
                    }

                $responseData = array(
                    'status' => 'ok',
                    'id' => $photo_id,
                    'usr_id' => $usr_id,
                    'like' => $like,
                );
            }
            $this->view->apiRender($responseData);
    }

    private function sendNotification($email, $from, $text){
            $arr = array(
                'controller' => 'gallery',
                'action' => 'photo',
            );
            $acc = new AccountController($arr);
            $name_from = 'Camagru';
            $email_from = 'kkostrub@student.unit.ua';
            $email_to = $email;
            $email_subject = 'New comment';
            $email_message = 'Hi, you have a new comment from ' . $from . ': "' . $text . '"';
            if(!$acc->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message))
               return 'error';
            else
                return 'true';
    }

    public function  commentAction(){
        $model = new Photo();
        $login = $_SESSION['authorize']['name'];
        $userModel = new Profile();
        $user = $userModel->getUser($login);
        $ntf = $model->getNotification($this->request['id'])[0]['notification'];
        $send = 'false';
        $responseData = array(
            'status' => 'error',
        );
        if($user){
            $model->addComments($this->request['id'], $user[0]['id'], $this->request['text']);
            if ($ntf === '1'){
                $send = $this->sendNotification($user[0]['email'],  $login, $this->request['text']);
            }
            $responseData = array(
                'status' => 'ok',
                'id' => $this->request['id'],
                'usr' => $user[0]['id'],
                'login' => $login,
                'text' => $this->request['text'],
                'email' => $user[0]['email'],
                'send' => $send,
                'ntf'=> $ntf,
            );
        }
        $this->view->apiRender($responseData);
    }

    public function notificationAction(){
        $model = new Account();
        $login = $_SESSION['authorize']['name'];
        $id = $model->getUserBy('login', $login)[0]['id'];
        if($model->updateNotification((int)$this->request['ntf'], $id)){
            $responseData = array(
                'status' => 'ok',
                'ntf' => $this->request['ntf'],
                'id' => $id,
            );
        }
        else {
            $responseData = array(
                'status' => 'error',
            );
        }
        $this->view->apiRender($responseData);
    }
}
