<?php
namespace app\controllers;

use app\core\Controller;


class ApiController extends Controller
{
    public  function profileEditAction(){

        $currentLogin = $_SESSION['authorize']['name'];
        $newLogin = $this->request['name'];
        $newEmail = $this->request['email'];

        // TODO update user`s data

        $responseData = array(
            'status' => 'ok',
            'data' => $currentLogin . ' | ' . $newLogin . ' | ' . $newEmail,
        );
        $this->view->apiRender($responseData);

    }
}
