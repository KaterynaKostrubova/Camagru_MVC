<?php
namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {
    public function indexAction() {
        $vars = [
            'name' => 'Kate',
            'age'  => '26',
            'arr'  => [1, 2, 3],
        ];
        $this->view->render('MAIN PAGE', $vars);
    }

    public function registerAction(){
        echo "MainRegister page";
    }
}