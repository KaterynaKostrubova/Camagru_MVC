<?php
namespace app\controllers;

use app\core\Controller;
use app\models\Account;
use app\models\Profile;


class ApiController extends Controller
{

    public  function profileEditAction(){
        $currentLogin = $_SESSION['authorize']['name'];
        $newLogin = $this->request['name'];
        $newEmail = $this->request['email'];

        // TODO update user`s data
        $model = new Account();
        $user = $model->getUser($currentLogin);
        $currentEmail = $user[0]['email'];
        $changed_name = false;
        $changed_email = false;

        if ($currentLogin != $newLogin || $currentEmail != $newEmail){
            if($model->checkValue($newLogin, 'users', 'login')) {
                $model->updateTable('users', 'login', $newLogin, 'login', $currentLogin);
                $_SESSION['authorize']['name'] = $newLogin;
                $cookie_name = $newLogin;
                $cookie_value = "login";
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                $currentLogin = $newLogin;
                $changed_name = true;
            }
            if ($model->checkValue($newEmail, 'users', 'email')) {
                $model->updateTable('users', 'email', $newEmail, 'email', $currentEmail);
                $currentEmail = $newEmail;
                $changed_email = true;
            }

            $responseData = array(
                'status' => 'ok',
                'name' => '',
                'email' => '',
                'data' => $currentLogin . ' | ' . $currentEmail,
            );

            if ($changed_name === true) {
                $responseData['name'] = 'yes';
            } else {
                $responseData['name'] = 'no';
            }
            if ($changed_email === true) {
                $responseData['email'] = 'yes';

            } else {
                $responseData['email'] = 'no';
            }

            $this->view->apiRender($responseData);
        }
    }
}
