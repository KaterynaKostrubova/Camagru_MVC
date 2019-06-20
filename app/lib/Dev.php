<?php

//Sets the value of a configuration option
//відображення помилок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// функція для дебага
function debug($str){
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit();
}