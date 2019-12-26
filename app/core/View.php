<?php

namespace app\core;

class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
//        debug( '1 '. $this->path);
    }

    public function render($title, $vars = []){
        extract($vars);
        $path = 'app/views/'.$this->path.'.php';
//        debug($path);
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'app/views/layouts/'.$this->layout.'.php';
        } else {
            echo 'not fount view: '.$this->path;
        }
    }

    public function apiRender($data){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode($data);
    }

    public static function errorCode($code){
        http_response_code($code);
        $path = 'app/views/error/'.$code.'.php';
        if(file_exists($path)){
            require $path;
        }
        exit();
    }

    public function redirect($url){
        header('Location: '.$url);
    }

    public function message($status, $message){
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url){
        exit(json_encode(['url' => $url]));
    }
}
