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

    public function profileEditAction()
    {

        $responseData = array(
            'Login' => '',
            'Email' => '',
            'Notification' => '',
            'Password' => '',
//            'data' => $currentLogin . ' | ' . $currentEmail . ' | ' . $currentNotification . ' | ' . $currentPass,
        );

        $currentLogin = $_SESSION['authorize']['name'];

        $newLogin = addslashes($this->test_input($this->request['name']));
        $newEmail = addslashes($this->test_input($this->request['email']));
        $newNotification = $this->request['notification'];

        $oldPass = hash('whirlpool', $this->test_input($this->request['oldPass']));
        $newPass = hash('whirlpool', $this->test_input($this->request['newPass']));
        $confirmPass = hash('whirlpool', $this->test_input($this->request['newPassConfirm']));

        $model = new Account();
        $user = $model->getUser($currentLogin);
        $currentPass = $user[0]['password'];
        $currentEmail = $user[0]['email'];
        $currentNotification = $user[0]['notification'];

        if ($oldPass !== '' && $newPass !== '' &&
            $confirmPass !== '' && $oldPass !== $newPass &&
            $newPass === $confirmPass && $oldPass === $currentPass){
            if($model->updateTable('users', 'password', $newPass, 'login', $currentLogin)){
                $responseData['password'] = $newPass;
            }
        }

        if($currentLogin != $newLogin){
            if ($model->checkValue($newLogin, 'users', 'login')) {
                if($model->updateTable('users', 'login', $newLogin, 'login', $currentLogin)){
                    $_SESSION['authorize']['name'] = $newLogin;
                    $cookie_name = $newLogin;
                    $cookie_value = "login";
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                    $responseData['login'] = $newLogin;
                }
            }
        }

        if($currentEmail != $newEmail){
            if ($model->checkValue($newEmail, 'users', 'email')) {
                if($model->updateTable('users', 'email', $newEmail, 'email', $currentEmail)){
                    $responseData['email'] = $newEmail;
                }
            }
        }

        if($currentNotification != $newNotification ) {
            $value = '1';
            if ($this->request['notification'] === false) {
                $value = '0';
            }
            if($model->updateTable('users', 'notification', $value, 'login', $currentLogin)){
                $responseData['notification'] = $value;
            }
        }

//        $responseData = array(
//            'status' => 'ok',
//            'name' => '',
//            'email' => '',
//            'notification' => '',
//            'data' => $currentLogin . ' | ' . $currentEmail . ' | ' . $currentNotification . ' | ' . $currentPass,
//        );
        $this->view->apiRender($responseData);

    }
    public function savePhotoAction()
    {
        $model = new Photo();
        $usr = $model->getUserData($_SESSION['authorize']['name']);
        $img = imagecreatefrompng($_POST["data"]);
        $png = imagecreatefrompng($_POST["filter"]);
        $cut = imagecreatetruecolor(960, 720);
        imagecopy($cut, $img, 0, 0, 0, 0, 960, 720);
        imagecopy($cut, $png, 0, 0, 0, 0, 960, 720);
        imagecopymerge($img, $cut, 0, 0, 0, 0, 960, 720, 100);
        $rnd_file_name = uniqid() . ".png";
        $file_name = "photos/" . $rnd_file_name;
        imagepng($img, $file_name, 5);
        $path = DIR_NAME  . '/' . $file_name;
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


    function delete_file($directory, $filename)
    {
        // открываем директорию (получаем дескриптор директории)
        $dir = opendir($directory);

        // считываем содержание директории
        while (($file = readdir($dir))) {
            // Если это файл и он равен удаляемому ...
            if ((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename")) {
                // ...удаляем его.
                unlink("$directory/$file");

                // Если файла нет по запрошенному пути, возвращаем TRUE - значит файл удалён.
                if (!file_exists($directory . "/" . $filename)) return TRUE;
            }
        }
        // Закрываем дескриптор директории.
        closedir($dir);
    }

    public function deletePhotoAction()
    {
        $model = new Photo();
        $test = $model->checkAvatar($this->request['id']);
        $testBg = $model->checkBg($this->request['id']);
        $path = '';
        $acc = new Account();
        $login = $_SESSION['authorize']['name'];
        $usr = $acc->getUserBy('login', $login);
        if ($test) {
            $photo_id = 1;
            if ($usr[0]['sex'] === 'female')
                $photo_id = 2;
            $model->changeAvatar($photo_id, $usr[0]['id']);
            $path = $model->getNameImage($photo_id)[0]['path'];
        }
        if ($testBg) {
            $model->changeBg(3, $usr[0]['id']);
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
            'flag' => $this->request['flag'],
        );

        $this->view->apiRender($responseData);
    }

    public function changeAvatarAction()
    {
        $model = new Photo();
        if ($this->request['id'] === '0') {
            $acc = new Account();
            $login = $_SESSION['authorize']['name'];
            $usr = $acc->getUserBy('login', $login);
            $photo_id = 1;
            if ($usr[0]['sex'] === 'female')
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

    public function changeBgAction()
    {
        $model = new Photo();

        if ($this->request['id'] === '0') {
            $acc = new Account();
            $login = $_SESSION['authorize']['name'];
            $usr = $acc->getUserBy('login', $login);
            $id = $usr[0]['id'];
        } else {
            $id = $this->request['id'];
        }
        $model->changeBg($this->request['bg_id'], $id);
        $path = $model->getNameImage($this->request['bg_id']);
        $responseData = array(
            'status' => 'ok',
            'id' => $id,
            'bg_id' => $this->request['bg_id'],
            'path' => $path[0]['path'],
        );
        $this->view->apiRender($responseData);
    }

    public function likeAction()
    {
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
            } else {
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

    private function sendNotification($email, $from, $text)
    {
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
        if (!$acc->sendEmail($name_from, $email_from, $email_to, $email_subject, $email_message))
            return 'error';
        else
            return 'true';
    }

    public function commentAction()
    {
        $model = new Photo();
        $login = $_SESSION['authorize']['name'];
        $userModel = new Profile();
        $user = $userModel->getUser($login);
        $ntf = $model->getNotification($this->request['id'])[0]['notification'];
        $send = 'false';
        $responseData = array(
            'status' => 'error',
        );
        if ($user) {
            $text = addslashes($this->test_input($this->request['text']));
            $model->addComments($this->request['id'], $user[0]['id'], $text);
            if ($ntf === '1') {
                $send = $this->sendNotification($user[0]['email'], $login, $text);
            }
            $responseData = array(
                'status' => 'ok',
                'id' => $this->request['id'],
                'usr' => $user[0]['id'],
                'login' => $login,
                'text' => $text,
                'email' => $user[0]['email'],
                'send' => $send,
                'ntf' => $ntf,
            );
        }
        $this->view->apiRender($responseData);
    }

//    public function notificationAction()
//    {
//        $model = new Account();
//        $login = $_SESSION['authorize']['name'];
//        $id = $model->getUserBy('login', $login)[0]['id'];
//        if ($model->updateNotification((int)$this->request['ntf'], $id)) {
//            $responseData = array(
//                'status' => 'ok',
//                'ntf' => $this->request['ntf'],
//                'id' => $id,
//            );
//        } else {
//            $responseData = array(
//                'status' => 'error',
//            );
//        }
//        $this->view->apiRender($responseData);
//    }

    public function infinitePaginationAction()
    {
        $model = new Gallery();
        $photo = $model->getPartPhotos($this->request['counter'] * $this->request['n'], $this->request['n']);
        $ownersAvatars = $model->getAllAvatars();
        $newHtml = '';

        for ($i = 0; $i < count($photo); $i++) {
            $search = $photo[$i]['photo_id'];
            $column = array_column($ownersAvatars, 'photo_id');
            $row = array_search($search, $column);

            $newHtml = $newHtml . '<div class="img_card img_card_' . $photo[$i]['id'] .
                '"><div class="img_head"><p class="crop_min_min"><img src="' .
                $ownersAvatars[$row]['path'] . '" alt="" class="avatar_min_min"></p><div class="usr_login">' .
                $photo[$i]['login'] . '</div>';

            if ($photo[$i]['login'] === $_SESSION['authorize']['name']) {
                $newHtml = $newHtml . '<div class="del"><input type="button" class="delete" id="delete_' .
                    $photo[$i]['id'] . '" onclick="deleteCard(event)"></div>';
            }
            $newHtml = $newHtml . '</div><a href="' . DIR_NAME . '/gallery/photo?id=' . $photo[$i]['id'] .
                '"><img class="photo photo-' . $photo[$i]['id'] . '" src="' . $photo[$i]['path'] . '" alt="picture"/></a></div>';
        }

        $responseData = array(
            'n' => count($photo),
            'nextPhotos' => $newHtml,
        );
        $this->view->apiRender($responseData);
    }



    public function paginationAction()
    {   $Account = new Account();
        $Photo = new Photo();
        $login = $_SESSION['authorize']['name'];
        $usr = $Account->getUserBy('login', $login);
        $numberPhotos = $Photo->getUserPhotosNumber($usr[0]['id']);


        if($this->request['counter'] < 0){
            $page = floor($numberPhotos / $this->request['perPage']);
            $nPage = $page;

        }
        else {
            $page = $this->request['counter'];
            $nPage = $this->request['counter'];
        }

        $photo = $Photo->getUsersPartPhotos($page * $this->request['perPage'], $this->request['perPage'], $usr[0]['id']);
        $responseData = array(
            'photos' => $photo,
            'user_id' => $usr[0]['id'],
            'numPage' => $nPage,
            'perPage' => $this->request['perPage'],
            'action' => $this->request['action'],
            'numberPhotos' => (int)$numberPhotos,
        );

        $this->view->apiRender($responseData);
    }
}
