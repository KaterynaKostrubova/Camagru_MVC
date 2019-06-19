<?php

namespace app\core;

use app\core\View;

abstract class Controller {

    public $route;
    public $view;
    public $acl;

    public function __construct($route) {
//        echo '<p>hello</p>';
//        var_dump($route);
        $this->route =$route;

//        $_SESSION['admin'] = 1;
//        $_SESSION['authorize']['id'] = 1;
//
        if(!$this->checkAcl()){
//            View::errorCode(403);
            header('Location: /camagru_mvc/account/signup');
        };
//        echo 323232;
        $this->view = new View($route);
//        $this->before();
        $this->model = $this->loadModel($route['controller']);

    }

    public function loadModel($name){
        $path = 'app\models\\'.ucfirst($name);
        if (class_exists($path)){
            return new $path();
        }
//        debug($path);
    }

    public function checkAcl(){
        $this->acl = require 'app/acl/'.$this->route['controller'].'.php';
        if ($this->isAcl('all')){
            return true;
        }
        elseif (isset($_SESSION['authorize']['name']) and $this->isAcl('authorize')){
            return true;
        }
        elseif (!isset($_SESSION['authorize']['name']) and $this->isAcl('guest')){
            return true;
        }
        elseif (isset($_SESSION['admin']) and $this->isAcl('admin')){
            return true;
        }
        return false;
    }


    public function isAcl($key){
        return in_array($this->route['action'], $this->acl[$key]);
    }
}
