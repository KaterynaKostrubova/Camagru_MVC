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

    }
}
