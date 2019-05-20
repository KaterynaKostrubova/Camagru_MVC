<?php

namespace app\core;

use app\core\View;

abstract class Controller {

    public $route;
    public $view;

    public function __construct($route) {
//        echo '<p>hello</p>';
//        var_dump($route);
        $this->route =$route;
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
}
