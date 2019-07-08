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
        $a = new Profile();
        $a->updateUsers($currentLogin, $newLogin);

        $responseData = array(
            'status' => 'ok',
            'data' => $currentLogin . ' | ' . $newLogin . ' | ' . $newEmail,
        );

//
        $this->view->apiRender($responseData);

    }
}
