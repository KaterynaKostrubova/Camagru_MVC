<?php

namespace app\core;

use app\core\View;

class Router {

    protected $routes = [];
    protected  $params = [];

    public function __construct(){
        $arr = require 'app/config/routes.php';

        foreach ($arr as $key => $val){
            $this->add($key, $val);
        }
//        debug($this->routes);
    }

    //add route
    public function add($route, $params) {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    //check route
    public function match() {
//        debug($_SERVER);
        $rootDirPath = trim(str_replace(APP_ROOT_DIR, '', $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI']), '/');
        $url = ($rootDirPath ? $rootDirPath : 'default/index');
//        debug(APP_ROOT_DIR);
        foreach ($this->routes as $route => $params){
            if (preg_match($route, $url, $matches)){
//                var_dump($params);
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run() {
        if($this->match()){
//            echo '<p>controller: <b>'.$this->params['controller'].'</b></p>';
//            echo '<p>action: <b>'.$this->params['action'].'</b></p>';
                $path = 'app\controllers\\'.ucfirst($this->params['controller'].'Controller');
                if(class_exists($path)){
                    $action = $this->params['action'].'Action';
                    if(method_exists($path, $action)) {
                        $controller = new $path($this->params);
                        $controller->$action();
                    } else {
                        View::errorCode(404);
                    }
                } else {
                    View::errorCode(404);
                }
        } else {
            View::errorCode(404);
        }
    }



}
