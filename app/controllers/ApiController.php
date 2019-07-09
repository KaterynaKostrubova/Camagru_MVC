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

        if ($currentLogin != $newLogin){
            if($model->checkValue($newLogin, 'users', 'login')){
                $model->updateTable('users', 'login', $newLogin, 'login', $currentLogin);
                $_SESSION['authorize']['name'] = $newLogin;
                $cookie_name = $newLogin;
                $cookie_value = "login";
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            } else{
                //debug('same name already exist');
            }

        }
        if ($currentEmail !== $newEmail){
            if($model->checkValue($newEmail, 'users','email')){
                $model->updateTable('users', 'email', $newEmail, 'email', $currentEmail);
            }
            else
                debug('same email already exist');
        }



        $responseData = array(
            'status' => 'ok',
            'data' => $currentLogin . ' | ' . $newLogin . ' | ' . $newEmail,
        );
        $this->view->apiRender($responseData);

    }
}
