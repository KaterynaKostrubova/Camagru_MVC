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

        $uri = $_SERVER['REQUEST_URI'];
        $docRoot = $_SERVER['DOCUMENT_ROOT'];
        $rootDirPath1 = trim(str_replace(APP_ROOT_DIR, '', $docRoot . $uri), '/');
        $arr = explode("?", $rootDirPath1);
        $rootDirPath = $arr[0];
        $url = ($rootDirPath ? $rootDirPath : 'default/index');
        foreach ($this->routes as $route => $params){
            if (preg_match($route, $url, $matches)){
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
                        echo $action;
                        View::errorCode(404);
                    }
                } else {
                    echo "2";
                    View::errorCode(404);
                }
        } else {
            echo "3";
            View::errorCode(404);
        }
    }



}
